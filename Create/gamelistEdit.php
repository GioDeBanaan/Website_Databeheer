<?php
require_once __DIR__ . "/../Models/gamelistget.php";

if (!isset($game)) {
    if (!isset($_GET['id'])) {
        die("Missing game id");
    }

    $gameModel = new Game();
    $game = $gameModel->find((int) $_GET['id']);

    if (!$game) {
        die("Game not found");
    }
}
?>
<html>
    <head>
        <title>Edit game</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Edit game</h1>
        <form method="post" action="../Pages/gamelist.php?action=update&id=<?= htmlspecialchars($game['game_id']) ?>">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/gamelistForm.php"; ?>
        <button type="submit" class="btn btn-primary">Update game</button>
    </form>
    </body>
    </html>