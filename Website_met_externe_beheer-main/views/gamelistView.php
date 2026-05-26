<?php
    if (!isset($gameresult)) {
        die("gameresult not passed to view");
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title> Games </title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class=" navbar-nav ">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link">Home </a>
                </li>
                <li class="nav-item">
                    <a href="gamelist.php" class="navbar-brand"> Game list</a>
                </li>
                <li class="nav-item">
                    <a href="customers.php" class="nav-link"> Customers</a>
                </li>
                <li class="nav-item">
                    <a href="employee.php" class="nav-link"> Employees</a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="nav-link"> Suppliers</a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link"> Transactions</a>
                </li>
            </ul>
        </header>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Create/gamelistCreate.php" class="btn btn-success mb-3">Add new game</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Game description</th>
                <th>Release date</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Rating</th>
                <th>Rawg rating</th>
                <th>Created at</th>
                <th>Last updated at</th>
                <th>update</th> 
                <th>delete</th>
            </tr>
            <?php foreach ($gameresult as $game):?>
                <tr>
                    <td><?= htmlspecialchars($game["title"]) ?></td>
                    <td><?= htmlspecialchars($game["description"]) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($game["released_at"]) ?></td>
                    <td><?= htmlspecialchars($game["genre_names"] ?? $game["genre_name"] ?? '') ?></td>
                    <td><?= htmlspecialchars($game["platform_names"] ?? $game["platform_name"] ?? '') ?></td>
                    <td>🟊<?= is_numeric($game["personal_rating"]) ? number_format((float)$game["personal_rating"], 1, '.', '') : htmlspecialchars($game["personal_rating"]) ?></td>
                    <td>🟊<?= htmlspecialchars($game["rawg_rating"]) ?></td>
                    <td><?= htmlspecialchars($game["created_at"]) ?></td>
                    <td><?= htmlspecialchars($game["updated_at"]) ?></td>
                    <td><a href="../Create/gamelistEdit.php?id=<?= $game['game_id'] ?>" class="btn btn-primary">Edit</a></td>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?= $game['game_id'] ?>, '<?= htmlspecialchars($game['title']) ?>', '<?= htmlspecialchars($game['rawg_id'] ?? '') ?>')">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="deleteImage" src="../mqdefault.jpg" alt="Game Image" class="img-fluid mb-3">
                    <p>Are you sure you want to delete <strong id="deleteTitle"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deleteGameId = null;

        function setDeleteData(gameId, gameTitle) {
            deleteGameId = gameId;
            document.getElementById('deleteTitle').textContent = gameTitle;
        }

        function confirmDelete() {
            if (deleteGameId) {
                window.location.href = '../Delete/gamelistDelete.php?id=' + deleteGameId;
            }
        }
    </script>
    </body>
</html>