<?php
// Simple RAWG proxy endpoint for client-side searches
// Returns JSON only — avoid any HTML output

header('Content-Type: application/json; charset=utf-8');
// short-circuit accidental output buffering
ob_start();

// Allow only GET requests for search
$action = $_GET['action'] ?? '';
if ($action !== 'search') {
    http_response_code(400);
    echo json_encode(["error" => "unsupported_action", "action" => $action]);
    exit;
}

$query = trim((string)($_GET['query'] ?? ''));
if ($query === '') {
    http_response_code(400);
    echo json_encode(["error" => "missing_query"]);
    exit;
}

// Use known RAWG API key (matches other code in repo)
$rawgKey = '33ddc7bd021d4630b707464fe32c531b';
$url = 'https://api.rawg.io/api/games?search=' . rawurlencode($query) . '&page_size=10&key=' . $rawgKey;

$opts = ['http' => ['method' => 'GET', 'header' => "Accept: application/json\r\n"]];
$context = stream_context_create($opts);
$response = @file_get_contents($url, false, $context);

// clear any accidental buffer (HTML etc.) before emitting JSON
ob_end_clean();

if ($response === false) {
    http_response_code(502);
    echo json_encode(["error" => "rawg_fetch_failed"]);
    exit;
}

$decoded = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(502);
    // include a short snippet for debugging, avoid huge payloads
    $snippet = substr($response, 0, 512);
    echo json_encode(["error" => "invalid_rawg_response", "snippet" => $snippet]);
    exit;
}

echo json_encode($decoded);
exit;

