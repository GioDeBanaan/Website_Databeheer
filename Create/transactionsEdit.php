<?php
require_once __DIR__ . "/../Models/transactionsget.php";

if (!isset($transactionresults)) {
    if (!isset($_GET['id'])) {
        die("Missing transaction id");
    }

    $transactionModel = new Transaction();
    $transaction = $transactionModel->getTransactionById($_GET['id']);

    if (!$transaction) {
        die("Transaction not found");
    }
}
?>
<html>
    <head>
        <title>Edit transaction</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <center><h1>Edit transaction</h1></center>
        <form method="post" action="../Pages/transactions.php?action=update&id=<?= htmlspecialchars($transaction['transaction_id']) ?>">
            <?php include __DIR__ . "/../Models/config.php"; 
            include __DIR__ . "/transactionsForm.php"; ?>
        <button type="submit" class="btn btn-primary">Update transaction</button>
    </form>
    </body>
    </html>
