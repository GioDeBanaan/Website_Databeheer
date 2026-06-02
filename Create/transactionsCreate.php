<html>
    <head>
        <title>Add transaction</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
        <h1>Add new transaction</h1>
        </div>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Pages/transactions.php" class="btn btn-success mb-3">Return</a>
        </div> 
        <form method="post" action="../Pages/transactionslist.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/transactionsForm.php"; ?>
        <button type="submit" class="btn btn-primary">Add transaction</button>
    </form>
    </body>
</html>