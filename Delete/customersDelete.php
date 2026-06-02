<?php
require_once __DIR__ . '/../Models/config.php';

$customerId = $_GET['customer_id'] ?? $_GET['id'] ?? null;

if ($customerId !== null) {
	try {
		$conn->beginTransaction();

		$deleteTransactions = "DELETE FROM transactions WHERE customer_id = :customer_id";
		$stmt = $conn->prepare($deleteTransactions);
		$stmt->execute([
			":customer_id" => $customerId
		]);

		$deleteCustomer = "DELETE FROM customers WHERE customer_id = :customer_id";
		$stmt = $conn->prepare($deleteCustomer);
		$stmt->execute([
			":customer_id" => $customerId
		]);

		$conn->commit();

		header("Location: ../Pages/customers.php?status=succesdel");
		exit;

	} catch (PDOException $e) {
		$conn->rollBack();
		echo "Fout: " . $e->getMessage();
	}
} else {
	header("Location: ../Pages/customers.php?status=fail");
	exit;
}