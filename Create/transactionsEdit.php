<?php
// 1. Include your Transaction class file
require_once __DIR__ . "/../Controller/transactionsController.php"; // Adjust path if needed
require_once __DIR__ . "/../Models/config.php";
$transactionObj = new Transaction();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Load games for the dropdown
$games = $conn->query("SELECT game_id, title FROM games ORDER BY title ASC")->fetchAll(PDO::FETCH_ASSOC);

// Create a variable to track if we just saved successfully
$saveSuccess = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'transaction_type' => $_POST['transaction_type'] ?? null,
        'customer_name'    => $_POST['customer_name'] ?? null,
        'company'          => $_POST['company'] ?? null,
        'game_id'          => $_POST['game_id'] ?? null,
        'transaction_date' => $_POST['transaction_date'] ?? null,
        'quantity'         => $_POST['quantity'] ?? null,
        'unit_price'       => $_POST['unit_price'] ?? null,
        'discount_percent' => $_POST['discount_percent'] ?? null,
        'tax_percent'      => $_POST['tax_percent'] ?? null,
        'payment_method'   => $_POST['payment_method'] ?? null,
        'payment_status'   => $_POST['payment_status'] ?? null,
        'order_status'     => $_POST['order_status'] ?? null,
    ];

    if ($transactionObj->update($id, $formData)) {
        $saveSuccess = true; // Set this to true instead of redirecting!
    } else {
        $error = "Failed to update transaction. Please try again.";
    }
}

// Always fetch the freshest data from the DB to show in the form below
$transaction = $transactionObj->find($id);
if (!$transaction) {
    die("Error: Transaction record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Transaction</title>
</head>
<body>
        <div class="container mt-4 d-flex justify-content-center" >
            <h1>Add new transaction</h1>
        </div>          
            <form action="transactionsEdit.php?id=<?= $id ?>" method="POST">
            <div class="container mt-4 d-flex justify-content-center">
            <a href="../Pages/transactions.php" class="btn btn-success mb-3">Return</a>
            </div>            

            <div class="mb-3">
                <label class="form-label d-block fw-bold">Transaction Type:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="transaction_type" value="sale" id="type_sale" required <?= ($transaction['transaction_type'] ?? '') === 'sale' ? 'checked' : '' ?>>
                    <label class="form-check-label" href="type_sale">Sale</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="transaction_type" value="purchase" id="type_purchase" required <?= ($transaction['transaction_type'] ?? '') === 'purchase' ? 'checked' : '' ?>>
                    <label class="form-check-label" href="type_purchase">Purchase</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="transaction_type" value="return" id="type_return" required <?= ($transaction['transaction_type'] ?? '') === 'return' ? 'checked' : '' ?>>
                    <label class="form-check-label" href="type_return">Return</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Customer:</label>
                <input type="text" class="form-control" name="customer_name" placeholder="Enter customer name" required value="<?= htmlspecialchars($transaction['customer_name'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Company:</label>
                <input type="text" class="form-control" name="company" placeholder="Enter Company's name" required value="<?= htmlspecialchars($transaction['company'] ?? '') ?>">
            </div>   

            <div class="mb-3">
                <label class="form-label fw-bold">Game name:</label>
                    <select class="form-control" name="game_id" required>
                        <option value="">Select a game</option>
                        <?php foreach ($games as $game): ?>
                            <option value="<?= htmlspecialchars($game['game_id']) ?>" <?= (int)($transaction['game_id'] ?? 0) === (int)$game['game_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($game['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Transaction Date:</label>
                <input type="date" class="form-control" name="transaction_date" required value="<?= htmlspecialchars($transaction['transaction_date'] ?? '') ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Quantity:</label>
                    <input type="number" class="form-control" name="quantity" required min="1" value="<?= htmlspecialchars($transaction['quantity'] ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Unit Price:</label>
                    <input type="number" class="form-control" name="unit_price" required min="0" step="0.01" value="<?= htmlspecialchars($transaction['unit_price'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Discount Percent:</label>
                    <input type="number" class="form-control" name="discount_percent" required min="0" max="100" value="<?= htmlspecialchars($transaction['discount_percent'] ?? '0') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tax Percent:</label>
                    <input type="number" class="form-control" name="tax_percent" required min="0" max="100" value="<?= htmlspecialchars($transaction['tax_percent'] ?? '0') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Payment Method:</label>
                <input type="text" class="form-control" name="payment_method" placeholder="e.g. Credit Card, Cash" required value="<?= htmlspecialchars($transaction['payment_method'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label d-block fw-bold">Payment Status:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_status" value="paid" id="pay_paid" required <?= ($transaction['payment_status'] ?? '') === 'paid' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pay_paid">Paid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_status" value="pending" id="pay_pending" required <?= ($transaction['payment_status'] ?? '') === 'pending' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pay_pending">Pending</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_status" value="failed" id="pay_failed" required <?= ($transaction['payment_status'] ?? '') === 'failed' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pay_failed">Failed</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Order Status:</label>
                <input type="text" class="form-control" name="order_status" placeholder="Enter order status" required value="<?= htmlspecialchars($transaction['order_status'] ?? '') ?>">
            </div>

            <div class="mt-4 mb-5">
                <button type="submit" class="btn btn-primary px-4">Update Transaction</button>
                <a href="../Pages/transactions.php" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form> 
    </div>
</body>
</html>