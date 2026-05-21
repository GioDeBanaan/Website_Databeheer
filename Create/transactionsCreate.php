<html>
    <head>
        <title>Add transaction</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Add new transaction</h1>
        <form method="post" action="../Pages/transactionslist.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/transactionslistForm.php"; ?>
        <button type="submit" class="btn btn-primary">Add transaction</button>
    </form>
    </body>
</html>