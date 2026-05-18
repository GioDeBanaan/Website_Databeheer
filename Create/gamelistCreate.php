<html>
    <head>
        <title>Add game</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Add new game</h1>
        <form method="post" action="../Pages/gamelist.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/gamelistForm.php"; ?>
        <button type="submit" class="btn btn-primary">Add game</button>
    </form>
    </body>
</html>