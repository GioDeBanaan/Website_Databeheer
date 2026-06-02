<?php
    $newOrder = ($_GET['order'] ?? 'DESC') === 'DESC' ? 'ASC' : 'DESC';
    $currentSort = $_GET['sort'] ?? 'supplier_id';
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Suppliers</title>
        <style>
            body {
                background-color: #f8f9fa;
            }
            thead tr {
                background-color: #343a40;
                color: white;
            }
            th a {
                color: #1a37c6;
                text-decoration: none;
            }
            thead th a:hover {
                text-decoration: underline;
            }
            tbody tr:hover {
                background-color: #f1f3f5;
            }
        </style>
    </head>
    <body>
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

        <div class="container-fluid mt-4 px-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Suppliers</h4>
                <a href="../Create/suppliersCreate.php" class="btn btn-success">Add new supplier</a>
            </div>

            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th><a href="?sort=supplier_id&order=<?= $newOrder ?>">ID <?= $currentSort === 'supplier_id' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th><a href="?sort=supplier_code&order=<?= $newOrder ?>">Code <?= $currentSort === 'supplier_code' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th><a href="?sort=company_name&order=<?= $newOrder ?>">Company <?= $currentSort === 'company_name' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th><a href="?sort=contact_person&order=<?= $newOrder ?>">Contact person <?= $currentSort === 'contact_person' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th>Email / Phone</th>
                            <th>Website</th>
                            <th>Address</th>
                            <th>KVK / BTW</th>
                            <th>Bank account</th>
                            <th><a href="?sort=delivery_time_days&order=<?= $newOrder ?>">Delivery time <?= $currentSort === 'delivery_time_days' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th><a href="?sort=supplier_rating&order=<?= $newOrder ?>">Rating <?= $currentSort === 'supplier_rating' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?></a></th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Suppliersresult as $supplier): ?>
                            <tr>
                                <td><?= htmlspecialchars($supplier["supplier_id"]) ?></td>
                                <td><?= htmlspecialchars($supplier["supplier_code"]) ?></td>
                                <td><?= htmlspecialchars($supplier["company_name"]) ?></td>
                                <td><?= htmlspecialchars($supplier["contact_person"] ?? '-') ?></td>
                                <td>
                                    <?= htmlspecialchars($supplier["email"]) ?><br>
                                    <small class="text-muted"><?= htmlspecialchars($supplier["phone"] ?? '-') ?></small>
                                </td>
                                <td><?= htmlspecialchars($supplier["website"] ?? '-') ?></td>
                                <td class="text-nowrap">
                                    <?= htmlspecialchars($supplier["street"] ?? '') ?> <?= htmlspecialchars($supplier["house_number"] ?? '') ?><br>
                                    <?= htmlspecialchars($supplier["postal_code"] ?? '') ?>
                                    <small class="text-muted"><?= htmlspecialchars($supplier["city"] ?? '') ?>, <?= htmlspecialchars($supplier["country"] ?? '') ?></small>
                                </td>
                                <td>
                                    <small>KVK: <?= htmlspecialchars($supplier["chamber_of_commerce_number"] ?? '-') ?></small><br>
                                    <small>BTW: <?= htmlspecialchars($supplier["vat_number"] ?? '-') ?></small>
                                </td>
                                <td><?= htmlspecialchars($supplier["bank_account"] ?? '-') ?></td>
                                <td><?= htmlspecialchars($supplier["delivery_time_days"] ?? '-') ?> days</td>
                                <td><?= htmlspecialchars($supplier["supplier_rating"] ?? '-') ?></td>
                                <td>
                                    <?php if ($supplier["is_active"] == 1): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($supplier["notes"] ?? '-') ?></td>
                                <td><small><?= htmlspecialchars($supplier["created_at"]) ?></small></td>
                                <td><small><?= htmlspecialchars($supplier["updated_at"]) ?></small></td>
                                <td class="text-nowrap">
                                    <a href="suppliers.php?action=edit&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="suppliers.php?action=delete&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>