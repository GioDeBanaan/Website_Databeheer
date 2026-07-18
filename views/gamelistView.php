<!-- 08/06/2026 made by Kai Hiraki -->
<?php
    if (!isset($gameresult)) {
        die("gameresult not passed to view");
    }
    $searchQuery = isset($_GET['search']) && trim($_GET['search']) !== '' ? '&search=' . urlencode(trim($_GET['search'])) : '';
    $sortParam = htmlspecialchars($_GET['sort'] ?? 'newest');
    $currentPage = $currentPage ?? 1;
    $totalPages = $totalPages ?? 1;
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
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="gamelist.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search games..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? 'newest') ?>">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="gamelist.php?sort=newest<?= $searchQuery ?>" class="btn btn-outline-secondary <?= ($sortParam === 'newest') ? 'active' : '' ?>">Newest</a>
                    <a href="gamelist.php?sort=oldest<?= $searchQuery ?>" class="btn btn-outline-secondary <?= ($sortParam === 'oldest') ? 'active' : '' ?>">Oldest</a>
                    <a href="../Create/gamelistCreate.php" class="btn btn-success">Add new game</a>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Game description</th>
                <th>Release date</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Rawg rating</th>
                <th>Platform</th>
                <th>Genre</th>
                <th>Created at</th>
                <th>Last updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($gameresult as $game):?>
                <tr>
                    <td><?= htmlspecialchars($game["title"]) ?></td>
                    <td><?= htmlspecialchars($game["description"]) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($game["released_at"]) ?></td>
                    <td>€<?= htmlspecialchars($game["price"]) ?></td>
                    <td>🟊<?= is_numeric($game["personal_rating"]) ? number_format((float)$game["personal_rating"], 1, '.', '') : htmlspecialchars($game["personal_rating"]) ?></td>
                    <td>🟊<?= ($game["rawg_rating"] === '0.0' || $game["rawg_rating"] === 0 || $game["rawg_rating"] === 0.0)
                        ? 'n/a'
                        : htmlspecialchars($game["rawg_rating"]) ?></td>
                    <td><?= htmlspecialchars($game["platform_names"] ?? $game["platform_name"] ?? '') ?></td>
                    <td><?= htmlspecialchars($game["genre_names"] ?? $game["genre_name"] ?? '') ?></td>
                    <td><?= htmlspecialchars($game["created_at"]) ?></td>
                    <td><?= htmlspecialchars($game["updated_at"]) ?></td>
                    <td><a href="../Create/gamelistEdit.php?id=<?= $game['game_id'] ?>" class="btn btn-primary">Edit</a></td>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?= $game['game_id'] ?>, '<?= htmlspecialchars($game['title']) ?>', '<?= htmlspecialchars($game['rawg_id'] ?? '') ?>')">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Game list pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="gamelist.php?page=<?= max(1, $currentPage - 1) ?>&sort=<?= $sortParam ?><?= $searchQuery ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="gamelist.php?page=<?= $i ?>&sort=<?= $sortParam ?><?= $searchQuery ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="gamelist.php?page=<?= min($totalPages, $currentPage + 1) ?>&sort=<?= $sortParam ?><?= $searchQuery ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
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