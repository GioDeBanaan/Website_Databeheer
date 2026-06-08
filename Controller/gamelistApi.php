<?php
// 08/06/2026 made by Kai Hiraki
require_once __DIR__ . '/../Models/config.php';

header('Content-Type: text/html; charset=utf-8');

$apiKey = '33ddc7bd021d4630b707464fe32c531b';

// Handle JSON search requests
if (isset($_GET['action']) && $_GET['action'] === 'search') {
    header('Content-Type: application/json');
    
    $query = $_GET['query'] ?? '';
    if (empty($query)) {
        http_response_code(400);
        echo json_encode(['error' => 'Query parameter is required']);
        exit;
    }

    $results = searchRawgGames($query, $apiKey);
    echo json_encode($results);
    exit;
}

function searchRawgGames(string $query, string $apiKey): array
{
    $url = 'https://api.rawg.io/api/games?search=' . rawurlencode($query) . '&page_size=10&key=' . $apiKey;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErrNo = curl_errno($ch);
    $curlErr = curl_error($ch);
    curl_close($ch);
    
    if ($curlErrNo) {
        return ['error' => 'cURL error: ' . $curlErr, 'results' => []];
    }
    
    if ($httpCode < 200 || $httpCode >= 300) {
        $decoded = json_decode($response, true);
        $msg = $decoded['detail'] ?? $decoded['message'] ?? $response;
        return ['error' => 'RAWG API returned HTTP ' . $httpCode . ': ' . $msg, 'results' => []];
    }
    
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON response from RAWG API', 'results' => []];
    }
    
    return [
        'results' => $data['results'] ?? [],
        'count' => $data['count'] ?? (isset($data['results']) ? count($data['results']) : 0)
    ];
}

function fetchRawgRating(string $title, string $apiKey): ?string
{
    $url = 'https://api.rawg.io/api/games?search=' . rawurlencode($title) . '&page_size=1&key=' . $apiKey;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);
    $curlErrNo = curl_errno($ch);
    $curlErr = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($curlErrNo) {
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    if ($httpCode < 200 || $httpCode >= 300) {
        return null;
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return null;
    }

    if (!isset($data['results'][0]['rating'])) {
        return null;
    }

    $rawRating = (float)$data['results'][0]['rating'];
    $doubledRating = $rawRating * 2;
    return number_format($doubledRating, 1, '.', '');
}

try {
    $stmt = $conn->query('SELECT game_id, title, rawg_rating FROM games ORDER BY title ASC');
    $titles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    echo '<p>Database error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    exit;
}

$updateStmt = $conn->prepare('UPDATE games SET rawg_rating = :rawg_rating WHERE game_id = :game_id');
$games = [];
foreach ($titles as $row) {
    $rawgRating = $row['rawg_rating'];
    $displayRating = $rawgRating;

    if ($rawgRating === null || $rawgRating === '') {
        $displayRating = fetchRawgRating($row['title'], $apiKey);
        if ($displayRating !== null) {
            $updateStmt->execute([
                ':rawg_rating' => $displayRating,
                ':game_id' => $row['game_id'],
            ]);
        }
    } elseif (is_numeric($rawgRating) && (float)$rawgRating <= 5.0) {
        $displayRating = number_format((float)$rawgRating * 2, 1, '.', '');
    }

    $games[] = [
        'title' => $row['title'],
        'rawg_rating' => $displayRating,
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Titles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Game Titles</h1>
        <?php if (empty($games)): ?>
            <div class="alert alert-warning">No games found in the database.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>RAWG Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $index => $game): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($game['title']) ?></td>
                            <td><?= htmlspecialchars($game['rawg_rating'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
