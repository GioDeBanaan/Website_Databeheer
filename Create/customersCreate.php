<html>
    <head>
        <title>Add customer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
<<<<<<< HEAD
        <div class="container mt-4 d-flex justify-content-center" >
        <h1>Add new customer</h1>
        </div>
        <form method="post" action="../Pages/customers.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/customersForm.php"; ?>
=======
        <h1>Add new customer</h1>
        <form method="post" action="../Pages/customers.php?action=store">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/customersForm.php"; ?>
        <button type="submit" class="btn btn-primary">Add customer</button>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
    </form>
    </body>
</html>