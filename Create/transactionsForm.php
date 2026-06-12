<?php
require_once __DIR__ . "/../Controller/transactionsController.php";

$controller = new TransactionsController();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
}
?>
        <title>Add Transaction</title>
    </head>
    <body>
        <form method="POST" action="../Pages/transactions.php?action=store">
            <div class="container mt-4 d-flex justify-content-center">
                <a href="../Pages/transactions.php" class="btn btn-success mb-3">Return</a>
            </div>

<form action="" method="POST">
    <div class="container mt-5">
        <div class="mb-3">
            <label class="form-label">Transaction Code:</label>
            <input type="text" name="transaction_code" placeholder="Enter transaction code" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Transaction Type:</label>
            <input type="radio" name="transaction_type" value="sale" required> Sale
            <input type="radio" name="transaction_type" value="purchase" required> Purchase
            <input type="radio" name="transaction_type" value="return" required> Return
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Customer:</label>
            <input type="text" name="customer_name" placeholder="Enter customer name" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Company:</label>
            <input type="text" name="Company" placeholder="Enter Company's name" required>
        </div>   
        <br>
        <div class="mb-3">
            <label class="form-label">Game name</label>
            <input type="text" name="game_name" placeholder="Enter game name" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Transaction Date:</label>
            <input type="date" name="transaction_date" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Quantity:</label>
            <input type="number" name="quantity" placeholder="Enter quantity" required min="1">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Unit Price:</label>
            <input type="number" name="unit_price" placeholder="Enter unit price" required min="0" step="1">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Discount Percent:</label>
            <input type="number" name="discount_percent" placeholder="Enter discount percent" required min="0" max="100" step="1">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Tax Percent:</label>
            <input type="number" name="tax_percent" placeholder="Enter tax percent" required min="0" max="100" step="1">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Payment Method:</label>
            <input type="text" name="payment_method" placeholder="Enter payment method" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Payment Status:</label>
            <input type="radio" name="payment_status" value="paid" required> Paid
            <input type="radio" name="payment_status" value="pending" required> Pending
            <input type="radio" name="payment_status" value="failed" required> Failed
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Order Status:</label>
            <input type="text" name="order_status" placeholder="Enter order status" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Add transaction</button>
            <a href="../Pages/transactions.php" class="btn btn-outline-secondary ms-2">Cancel</a>
        </div>
        <br>
    </div>
</form>