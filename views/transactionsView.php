<?php
if (!isset($transactionresults)) {
    die("transactionresults not passed to view");
}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title> Transactions </title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class=" navbar-nav ">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link">Home </a>
                </li>
                <li class="nav-item">
                    <a href="gamelist.php" class="navbar-brand"> Game list</a>
                </li>
                <li class="nav-item">
                    <a href="customers.php" class="nav-link"> Customers</a>
                </li>
                <li class="nav-item">
                    <a href="employee.php" class="nav-link"> Employees</a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="nav-link"> Suppliers</a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link"> Transactions</a>
                </li>
            </ul>
        </header>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Create/transactionsCreate.php" class="btn btn-success mb-3">Add new transaction</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Transaction id</th>
                <th>Transaction code</th>
                <th>Transaction type</th>
                <th>Customer</th>
                <th>Supplier id</th>
                <th>Employee id</th>
                <th>Game id</th>
                <th>Transaction date</th>
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Discount percent</th>
                <th>Tax percent</th>
                <th>Payment method</th>
                <th>Payment status</th>
                <th>Order status</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($transactionresults as $transaction):?>
                <tr>
                    <td><?= htmlspecialchars($transaction["transaction_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_code"]) ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_type"]) ?></td>
                    <td><?= htmlspecialchars($transaction["customer_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["supplier_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["employee_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["game_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_date"]) ?></td>
                    <td><?= htmlspecialchars($transaction["quantity"]) ?></td>
                    <td><?= htmlspecialchars($transaction["unit_price"]) ?></td>
                    <td><?= htmlspecialchars($transaction["discount_percent"]) ?></td>
                    <td><?= htmlspecialchars($transaction["tax_percent"]) ?></td>
                    <td><?= htmlspecialchars($transaction["payment_method"]) ?></td>
                    <td><?= htmlspecialchars($transaction["payment_status"]) ?></td>
                    <td><?= htmlspecialchars($transaction["order_status"]) ?></td>
                    <td><?= htmlspecialchars($transaction["created_at"]) ?></td>
                    <td><?= htmlspecialchars($transaction["updated_at"]) ?></td>
                    <td><a href="../Create/transactionsEdit.php?id=<?= $transaction['transaction_id'] ?>" class="btn btn-primary">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>