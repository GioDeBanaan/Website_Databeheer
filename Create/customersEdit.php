<?php
require_once __DIR__ . "/../Models/customersget.php";

if (!isset($customer)) {
    if (!isset($_GET['id'])) {
        die("Missing customer id");
    }

    $customerModel = new Customer();
    $customer = $customerModel->find((int) $_GET['id']);

    if (!$customer) {
        die("Customer not found");
    }
}
?>
<html>
    <head>
        <title>Edit customer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
            <h1>Edit customer</h1>
        </div>
        <form method="post" action="../Pages/customers.php?action=update&id=<?= htmlspecialchars($customer['customer_id']) ?>">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/customersForm.php"; ?>
    </form>
    </body>
    </html>