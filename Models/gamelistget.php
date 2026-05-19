<?php
require_once __DIR__ . "/config.php";

class Game
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
        $this->ensureJoinTables();
    }

    private function ensureJoinTables(): void
    {
        $this->conn->exec("CREATE TABLE IF NOT EXISTS game_genres (
            game_id int(11) NOT NULL,
            genre_id int(11) NOT NULL,
            PRIMARY KEY (game_id, genre_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->conn->exec("CREATE TABLE IF NOT EXISTS game_platforms (
            game_id int(11) NOT NULL,
            platform_id int(11) NOT NULL,
            PRIMARY KEY (game_id, platform_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->conn->exec("INSERT IGNORE INTO game_genres (game_id, genre_id)
            SELECT game_id, genre_id FROM games WHERE genre_id IS NOT NULL");

        $this->conn->exec("INSERT IGNORE INTO game_platforms (game_id, platform_id)
            SELECT game_id, platform_id FROM games WHERE platform_id IS NOT NULL");
    }

    public function all(): array
    {
        $sql = "SELECT g.game_id, g.title, g.description, g.released_at,
                       g.personal_rating,
                       GROUP_CONCAT(DISTINCT ge.name ORDER BY ge.name SEPARATOR ', ') AS genre_names,
                       GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR ', ') AS platform_names,
                       g.rawg_id, g.rawg_rating, g.created_at, g.updated_at
                FROM games g
                LEFT JOIN game_genres gg ON g.game_id = gg.game_id
                LEFT JOIN genres ge ON gg.genre_id = ge.genre_id
                LEFT JOIN game_platforms gp ON g.game_id = gp.game_id
                LEFT JOIN platforms p ON gp.platform_id = p.platform_id
                GROUP BY g.game_id, g.title, g.description, g.released_at, g.personal_rating, g.rawg_id, g.rawg_rating, g.created_at, g.updated_at
                ORDER BY g.game_id DESC";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT g.game_id, g.title, g.description, g.released_at,
                       g.personal_rating, g.genre_id, g.platform_id, g.rawg_id,
                       g.rawg_rating, g.created_at, g.updated_at
                FROM games g
                WHERE g.game_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $game = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$game) {
            return null;
        }

        $game['genre_ids'] = $this->getGenreIds($id);
        $game['platform_ids'] = $this->getPlatformIds($id);

        return $game;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO games (title, description, released_at, personal_rating, genre_id, platform_id, created_at, updated_at)
                VALUES (:title, :description, :released_at, :personal_rating, :genre_id, :platform_id, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':released_at', $data['released_at'], PDO::PARAM_STR);
        $stmt->bindValue(':personal_rating', $data['personal_rating'], PDO::PARAM_STR);
        $stmt->bindValue(':genre_id', $this->getPrimaryId($data['genre_ids']), $this->getPrimaryId($data['genre_ids']) === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':platform_id', $this->getPrimaryId($data['platform_ids']), $this->getPrimaryId($data['platform_ids']) === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->execute();

        $gameId = (int)$this->conn->lastInsertId();
        $this->syncGenres($gameId, $data['genre_ids']);
        $this->syncPlatforms($gameId, $data['platform_ids']);

        return $gameId;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE games
                SET title = :title,
                    description = :description,
                    released_at = :released_at,
                    personal_rating = :personal_rating,
                    genre_id = :genre_id,
                    platform_id = :platform_id,
                    updated_at = NOW()
                WHERE game_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':released_at', $data['released_at'], PDO::PARAM_STR);
        $stmt->bindValue(':personal_rating', $data['personal_rating'], PDO::PARAM_STR);
        $stmt->bindValue(':genre_id', $this->getPrimaryId($data['genre_ids']), $this->getPrimaryId($data['genre_ids']) === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':platform_id', $this->getPrimaryId($data['platform_ids']), $this->getPrimaryId($data['platform_ids']) === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $result = $stmt->execute();
        if ($result) {
            $this->syncGenres($id, $data['genre_ids']);
            $this->syncPlatforms($id, $data['platform_ids']);
        }

        return $result;
    }

    private function getPrimaryId(array $ids): ?int
    {
        return count($ids) > 0 ? $ids[0] : null;
    }

    private function getGenreIds(int $gameId): array
    {
        $stmt = $this->conn->prepare("SELECT genre_id FROM game_genres WHERE game_id = :game_id");
        $stmt->bindValue(':game_id', $gameId, PDO::PARAM_INT);
        $stmt->execute();

        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    private function getPlatformIds(int $gameId): array
    {
        $stmt = $this->conn->prepare("SELECT platform_id FROM game_platforms WHERE game_id = :game_id");
        $stmt->bindValue(':game_id', $gameId, PDO::PARAM_INT);
        $stmt->execute();

        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    private function syncGenres(int $gameId, array $genreIds): void
    {
        $this->conn->prepare("DELETE FROM game_genres WHERE game_id = :game_id")->execute([':game_id' => $gameId]);

        if (empty($genreIds)) {
            return;
        }

        $stmt = $this->conn->prepare("INSERT INTO game_genres (game_id, genre_id) VALUES (:game_id, :genre_id)");
        foreach (array_unique($genreIds) as $genreId) {
            $stmt->execute([':game_id' => $gameId, ':genre_id' => $genreId]);
        }
    }

    private function syncPlatforms(int $gameId, array $platformIds): void
    {
        $this->conn->prepare("DELETE FROM game_platforms WHERE game_id = :game_id")->execute([':game_id' => $gameId]);

        if (empty($platformIds)) {
            return;
        }

        $stmt = $this->conn->prepare("INSERT INTO game_platforms (game_id, platform_id) VALUES (:game_id, :platform_id)");
        foreach (array_unique($platformIds) as $platformId) {
            $stmt->execute([':game_id' => $gameId, ':platform_id' => $platformId]);
        }
    }
}
