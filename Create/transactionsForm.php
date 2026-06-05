<?php
include __DIR__ . "/../Controller/transactionsController.php";
?>
    <div class="container mt-5">
        <div class="mb-3">
            <label class="form-label">Transaction Code:</label>
            <input type="text" name="transaction_code" placeholder="Enter transaction code" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Transaction Type:</label>
            <input type="radio" name="transaction_type" value="sale" required>Sale</input>
            <input type="radio" name="transaction_type" value="purchase" required>Purchase</input>
            <input type="radio" name="transaction_type" value="return" required>Return</input>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Customer:</label>
            <input type="text" name="customer_id" placeholder="Enter customer ID" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Supplier ID:</label>
            <input type="text" name="supplier_id" placeholder="e.g. TRX000" required>
        </div>   
        <br>
        <div class="mb-3">
            <label class="form-label">Employee ID:</label>
            <input type="text" name="employee_id" placeholder="Enter employee ID" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Game ID:</label>
            <input type="text" name="game_id" placeholder="Enter game ID" required>
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
            <input type="radio" name="payment_status" value="Paid" required>Paid</input>
            <input type="radio" name="payment_status" value="Pending" required>Pending</input>
            <input type="radio" name="payment_status" value="Failed" required>Failed</input>
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
