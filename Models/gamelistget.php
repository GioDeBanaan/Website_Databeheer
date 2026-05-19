<?php
require_once __DIR__ . "/config.php";

class Game
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function all(): array
    {
        $sql = "SELECT g.game_id, g.title, g.description, g.released_at,
                       g.personal_rating, ge.name AS genre_name,
                       p.name AS platform_name, g.rawg_id,
                       g.rawg_rating, g.created_at, g.updated_at
                FROM games g
                LEFT JOIN genres ge ON g.genre_id = ge.genre_id
                LEFT JOIN platforms p ON g.platform_id = p.platform_id
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

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
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
        $stmt->bindValue(':genre_id', $data['genre_id'], $data['genre_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':platform_id', $data['platform_id'], $data['platform_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->execute();

        return (int)$this->conn->lastInsertId();
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
        $stmt->bindValue(':genre_id', $data['genre_id'], $data['genre_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':platform_id', $data['platform_id'], $data['platform_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}