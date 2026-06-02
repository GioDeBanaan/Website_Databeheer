<?php
require_once __DIR__ . '/../Models/config.php';

// Change 'transaction_id' to 'id' to match standard query strings
if (isset($_GET['id'])) {
    $transaction_id = $_GET['id'];

    $sql = "DELETE FROM transactions WHERE transaction_id = :transaction_id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':transaction_id' => $transaction_id
        ]);

        header('Location: ../Pages/transactions.php?status=succesdel');
        exit;
    } catch (PDOException $e) {
        echo 'Fout: ' . $e->getMessage();
        exit;
    }
}

// If it fails, redirect back to transactions, not employees!
header('Location: ../Pages/transactions.php?status=fail');
exit;