<?php
require_once "config.php";

// Check if ID parameter exists
if (isset($_GET['transaction_id'])) {
	$transaction_id = $_GET['transaction_id'];

	// SQL delete query
	$sql = "DELETE FROM project WHERE transaction_id = :transaction_id";

	// Execute with parameterized query (prevents SQL injection)
	try {			
		$stmt = $connection->prepare($sql);
		$stmt->execute([
			":transaction_id" => $transaction_id
			]);
			
		header("Location: transactions.php?status=succesdel");
		exit;

	}
	catch (PDOException $e) {
		echo "Fout: " . $e->getMessage();
	}
}
else {
	header("Location: transactions.php?status=fail");
	exit;
}