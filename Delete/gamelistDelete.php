<?php
require_once __DIR__ . '/../Models/config.php';

$gameId = $_GET['game_id'] ?? $_GET['id'] ?? null;

if ($gameId !== null) {
	try {
		$conn->beginTransaction();

		$deleteTransactions = "DELETE FROM transactions WHERE game_id = :game_id";
		$stmt = $conn->prepare($deleteTransactions);
		$stmt->execute([
			":game_id" => $gameId
		]);

		$deleteGame = "DELETE FROM games WHERE game_id = :game_id";
		$stmt = $conn->prepare($deleteGame);
		$stmt->execute([
			":game_id" => $gameId
		]);

		$conn->commit();

		header("Location: ../Pages/gamelist.php?status=succesdel");
		exit;

	} catch (PDOException $e) {
		$conn->rollBack();
		echo "Fout: " . $e->getMessage();
	}
} else {
	header("Location: ../Pages/gamelist.php?status=fail");
	exit;
}