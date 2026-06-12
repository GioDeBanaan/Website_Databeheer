<?php
    $newOrder = ($_GET['order'] ?? 'DESC') === 'DESC' ? 'ASC' : 'DESC';
    $currentSort = $_GET['sort'] ?? 'supplier_id';
    $searchQuery = isset($_GET['search']) && trim($_GET['search']) !== '' ? '&search=' . urlencode(trim($_GET['search'])) : '';
    $currentPage = $currentPage ?? 1;
    $totalPages = $totalPages ?? 1;
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Suppliers</title>
    </head>
    <body id="top">
        <header class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="../index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="gamelist.php" class="nav-link">Game list</a></li>
                <li class="nav-item"><a href="customers.php" class="nav-link">Customers</a></li>
                <li class="nav-item"><a href="employee.php" class="nav-link">Employees</a></li>
                <li class="nav-item"><a href="suppliers.php" class="navbar-brand">Suppliers</a></li>
                <li class="nav-item"><a href="transactions.php" class="nav-link">Transactions</a></li>
            </ul>
        </header>

        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="suppliers.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search suppliers..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? 'supplier_id') ?>">
                            <input type="hidden" name="order" value="<?= htmlspecialchars($_GET['order'] ?? 'DESC') ?>">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="../Create/suppliersCreate.php" class="btn btn-success">Add new supplier</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th><a href="?sort=supplier_id&order=<?= $newOrder ?><?= $searchQuery ?>">ID <?= $currentSort === 'supplier_id' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th><a href="?sort=supplier_code&order=<?= $newOrder ?><?= $searchQuery ?>">Code <?= $currentSort === 'supplier_code' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th><a href="?sort=company_name&order=<?= $newOrder ?><?= $searchQuery ?>">Company <?= $currentSort === 'company_name' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th><a href="?sort=contact_person&order=<?= $newOrder ?><?= $searchQuery ?>">Contact person <?= $currentSort === 'contact_person' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th>Email / Phone</th>
                <th>Website</th>
                <th>Address</th>
                <th>KVK / BTW</th>
                <th>Bank account</th>
                <th><a href="?sort=delivery_time_days&order=<?= $newOrder ?><?= $searchQuery ?>">Delivery time <?= $currentSort === 'delivery_time_days' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th><a href="?sort=supplier_rating&order=<?= $newOrder ?><?= $searchQuery ?>">Rating <?= $currentSort === 'supplier_rating' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                <th>Status</th>
                <th>Notes</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($Suppliersresult as $supplier): ?>
                <tr>
                    <td><?= htmlspecialchars($supplier["supplier_id"]) ?></td>
                    <td><?= htmlspecialchars($supplier["supplier_code"]) ?></td>
                    <td><?= htmlspecialchars($supplier["company_name"]) ?></td>
                    <td><?= htmlspecialchars($supplier["contact_person"] ?? '-') ?></td>
                    <td>
                        <?= htmlspecialchars($supplier["email"]) ?><br>
                        <?= htmlspecialchars($supplier["phone"] ?? '-') ?>
                    </td>
                    <td><?= htmlspecialchars($supplier["website"] ?? '-') ?></td>
                    <td class="text-nowrap">
                        <?= htmlspecialchars($supplier["street"] ?? '') ?> <?= htmlspecialchars($supplier["house_number"] ?? '') ?><br>
                        <?= htmlspecialchars($supplier["postal_code"] ?? '') ?><br>
                        <small class="text-muted"><?= htmlspecialchars($supplier["city"] ?? '') ?></small><br>
                        <small class="text-muted"><?= htmlspecialchars($supplier["country"] ?? '') ?></small>
                    </td>
                    <td>
                        KVK: <?= htmlspecialchars($supplier["chamber_of_commerce_number"] ?? '-') ?><br>
                        BTW: <?= htmlspecialchars($supplier["vat_number"] ?? '-') ?>
                    </td>
                    <td><?= htmlspecialchars($supplier["bank_account"] ?? '-') ?></td>
                    <td><?= htmlspecialchars($supplier["delivery_time_days"] ?? '-') ?> days</td>
                    <td><?= htmlspecialchars($supplier["supplier_rating"] ?? '-') ?></td>
                    <td><?= $supplier["is_active"] == 1 ? 'Active' : 'Inactive' ?></td>
                    <td><?= htmlspecialchars($supplier["notes"] ?? '-') ?></td>
                    <td><?= htmlspecialchars($supplier["created_at"]) ?></td>
                    <td><?= htmlspecialchars($supplier["updated_at"]) ?></td>
                    <td><a href="suppliers.php?action=edit&id=<?= $supplier['supplier_id'] ?>" class="btn btn-primary">Edit</a></td>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?= $supplier['supplier_id'] ?>, '<?= htmlspecialchars(addslashes($supplier['company_name'])) ?>')">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Supplier list pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="suppliers.php?page=<?= max(1, $currentPage - 1) ?>&sort=<?= $currentSort ?>&order=<?= $_GET['order'] ?? 'DESC' ?><?= $searchQuery ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="suppliers.php?page=<?= $i ?>&sort=<?= $currentSort ?>&order=<?= $_GET['order'] ?? 'DESC' ?><?= $searchQuery ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="suppliers.php?page=<?= min($totalPages, $currentPage + 1) ?>&sort=<?= $currentSort ?>&order=<?= $_GET['order'] ?? 'DESC' ?><?= $searchQuery ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="../are-you-sure.gif" alt="Supplier Image" class="img-fluid mb-3">
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
            let deleteSupplierId = null;

            function setDeleteData(supplierId, supplierName) {
                deleteSupplierId = supplierId;
                document.getElementById('deleteTitle').textContent = supplierName;
            }

            function confirmDelete() {
                if (deleteSupplierId) {
                    window.location.href = 'suppliers.php?action=delete&id=' + deleteSupplierId;
                }
            }
        </script>

        <div class="justify-content-center d-flex mb-4">
            <a href="#top" class="btn btn-outline-warning">Back to Top</a>
        </div>
    </body>
</html>