<?php
    require_once __DIR__ . "/../Controller/transactionsController.php";
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
                    <a href="gamelist.php" class="nav-link"> Game list</a>
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
                    <a href="transactions.php" class="navbar-brand"> Transactions</a>
                </li>
            </ul>
        </header>
        <table class="table table-bordered">
            <tr>
                <th>Transaction id</th>
                <th>Transaction code</th>
                <th>Transaction type</th>
                <th>Customer</th>
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
                <th>Shipping address</th>
                <th>Billing address</th>
                <th>Reference note</th>
                <th>Notes</th>
                <th>Created at</th>
                <th>Updated at</th>
            <?php foreach ($transactionresults as $transaction): ?>
                <tr>
                    <td><?= is_numeric($transaction["transaction_id"]) ? $transaction["transaction_id"] : "N/A" ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_code"]) ?></td>
                    <td><?= is_numeric($transaction["customer_id"]) ? $transaction["customer_id"] : "N/A" ?></td>
                    <td><?= is_numeric($transaction["employee_id"]) ? $transaction["employee_id"] : "N/A" ?></td>
                    <td><?= htmlspecialchars($transaction["game_id"]) ?></td>
                    <td><?= is_numeric($transaction["transaction_date"]) ? $transaction["transaction_date"] : "N/A" ?></td>
                    <td><?= is_numeric($transaction["quantity"]) ? $transaction["quantity"] : "N/A" ?></td>
                    <td><?= is_numeric($transaction["unit_price"]) ? $transaction["unit_price"] : "N/A" ?></td>
                    <td><?= is_numeric($transaction["discount_percent"]) ? $transaction["discount_percent"] : "N/A" ?>%</td>
                    <td><?= is_numeric($transaction["tax_percent"]) ? $transaction["tax_percent"] : "N/A" ?>%</td>
                    <td><?= htmlspecialchars($transaction["transaction_type"]) ?></td>
                    <td><?= htmlspecialchars($transaction["payment_method"]) ?></td>
                    <td><?= htmlspecialchars($transaction["payment_status"]) ?></td>
                    <td><?= htmlspecialchars($transaction["order_status"]) ?></td>
                    <td><?= htmlspecialchars($transaction["shipping_address"]) ?></td>
                    <td><?= htmlspecialchars($transaction["billing_address"]) ?></td>
                    <td><?= htmlspecialchars($transaction["reference_note"]) ?></td>
                    <td><?= htmlspecialchars($transaction["notes"]) ?></td>
                    <td><?= htmlspecialchars($transaction["created_at"]) ?></td>
                    <td><?= htmlspecialchars($transaction["updated_at"]) ?></td>
                    <td><a href="../Create/transactionsEdit.php?id=<?= $transaction['transaction_id'] ?>" class="btn btn-primary">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 7b1a628a42c4e78ecdb6fd5b00f3217c57c8bf44
