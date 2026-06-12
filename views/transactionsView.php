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
    <body id="top">
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

         <div class="container mt-4 d-flex justify-content-center">
            <a href="../Create/transactionsCreate.php" class="btn btn-success mb-3">Add new transaction</a>
        </div>

            <table class="table table-bordered">
            <tr>
                <th>Transaction id</th>
                <th>Transaction code</th>
                <th>Transaction type</th>
                <th>Customer Name</th>
                <th>Company</th>
                <th>Game name</th>
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
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($transactionresults as $transaction):?>
                <tr>
                    <td><?= htmlspecialchars($transaction["transaction_id"]) ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_code"]) ?></td>
                    <td><?= htmlspecialchars($transaction["transaction_type"]) ?></td>
                    <td><?= htmlspecialchars($transaction["customer_name"]) ?></td>
                    <td><?= htmlspecialchars($transaction["company"]) ?></td>
                    <td><?= htmlspecialchars($transaction["game_name"]) ?></td>
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
                    <td><a href="../Create/transactionsEdit.php?id=<?= $transaction['transaction_id'] ?>" class="btn btn-primary">Edit</a>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?= $transaction['transaction_id'] ?>, '<?= htmlspecialchars(addslashes($transaction['transaction_code'])) ?>')">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>

 <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="deleteImage" src="../mqdefault.jpg" alt="Game Image" class="img-fluid mb-3">
                    <p>Are you sure you want to delete <strong id="deleteTitle"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deletetransactionId = null;

        function setDeleteData(transactionId, transactionTitle) {
            deletetransactionId = transactionId;
            document.getElementById('deleteTitle').textContent = transactionTitle;
        }

        function confirmDelete() {
            if (deletetransactionId) {
                window.location.href = '../Delete/transactionsDelete.php?id=' + deletetransactionId;
            }
        }
    </script>
    <div class="justify-content-center d-flex mb-4">
        <a href="#top" class="btn btn-outline-warning scroll-to-top">Back to Top</a>
    </div>
    </body>
</html>