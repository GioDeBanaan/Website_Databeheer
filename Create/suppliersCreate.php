<html>
    <head>
        <title>Add Supplier</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
        <h1>Add new Supplier</h1>
        </div>
        <form method="post" action="../Pages/Suppliers.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/SuppliersForm.php"; ?>
    </form>
    </body>
</html>