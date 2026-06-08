<html>
    <head>
        <title>Add customer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
            <h1>Add new customer</h1>
        </div>
        <form method="post" action="../Pages/customers.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/customersForm.php"; ?>
    </form>
    </body>
</html>