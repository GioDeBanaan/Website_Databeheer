<!-- 08/06/2026 made by Kai Hiraki -->
<?php
require_once __DIR__ . '/../Models/config.php';

$gameId = $_GET['game_id'] ?? $_GET['id'] ?? null;

if ($gameId !== null) {
	try {
		$conn->beginTransaction();

		$deleteTransactions = "DELETE FROM transactions WHERE game_id = :game_id";
		$stmt = $conn->prepare($deleteTransactions);
		try {
			$stmt->execute([
				":game_id" => $gameId
			]);
		} catch (PDOException $e) {
			// If the transactions table uses a different column name (e.g. game_name),
			// attempt a fallback delete. Detect SQLSTATE 42S22 = column not found.
			if ($e->getCode() === '42S22') {
				$fallback = $conn->prepare("DELETE FROM transactions WHERE game_name = :game_id");
				$fallback->execute([
					":game_id" => $gameId
				]);
			} else {
				throw $e;
			}
		}

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