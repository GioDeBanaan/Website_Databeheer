<?php
require_once __DIR__ . '/../Models/config.php';

$transactionId = $_GET['transaction_id'] ?? $_GET['id'] ?? null;

if ($transactionId !== null) {
	try {
		$conn->beginTransaction();

		$deleteTransactions = "DELETE FROM transactions WHERE transaction_id = :transaction_id";
		$stmt = $conn->prepare($deleteTransactions);
		$stmt->execute([
			":transaction_id" => $transactionId
		]);

		$deletetransactions = "DELETE FROM transactions WHERE transaction_id = :transaction_id";
		$stmt = $conn->prepare($deletetransactions);
		$stmt->execute([
			":transaction_id" => $transactionId
		]);

		$conn->commit();

		header("Location: ../Pages/transactions.php?status=succesdel");
		exit;

	} catch (PDOException $e) {
		$conn->rollBack();
		echo "Fout: " . $e->getMessage();
	}
} else {
	header("Location: ../Pages/transactions.php?status=fail");
	exit;
}