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
                    <td><a href="../Create/transactionsEdit.php?id=<?= $transaction['transaction_id'] ?>" class="btn btn-primary">Edit</a>
                                    <div class="modal-body">
                    <img id="deleteImage" src="../mqdefault.jpg" alt="Game Image" class="img-fluid mb-3">
                    <p>Are you sure you want to delete <strong id="deleteTitle"></strong>?</p>
                </div>
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
                    <img id="deleteImage" src="../mqdefault.jpg" alt="Transaction Image" class="img-fluid mb-3">
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
        let deleteTransactionId = null;

        function setDeleteData(transactionId, transactionTitle) {
            deleteTransactionId = transactionId;
            document.getElementById('deleteTitle').textContent = transactionTitle;
        }

        function confirmDelete() {
            if (deleteTransactionId) {
                window.location.href = '../Delete/transactiondelete.php?id=' + deleteTransactionId;
            }
        }
    </script>

    </body>
</html>