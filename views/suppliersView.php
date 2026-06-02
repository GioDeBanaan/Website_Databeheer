<?php
    $newOrder = ($_GET['order'] ?? 'DESC') === 'DESC' ? 'ASC' : 'DESC';
    $currentSort = $_GET['sort'] ?? 'supplier_id';
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Suppliers</title>
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

        <div class="container mt-4 d-flex justify-content-center">
            <a href="../Create/suppliersCreate.php" class="btn btn-success mb-3">Add new supplier</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>
                    <a href="?sort=supplier_id&order=<?= $newOrder ?>">
                        ID <?= $currentSort === 'supplier_id' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="?sort=supplier_code&order=<?= $newOrder ?>">
                        Code <?= $currentSort === 'supplier_code' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="?sort=company_name&order=<?= $newOrder ?>">
                        Company <?= $currentSort === 'company_name' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="?sort=contact_person&order=<?= $newOrder ?>">
                        Contact person <?= $currentSort === 'contact_person' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>Email / Phone</th>
                <th>Website</th>
                <th>Address</th>
                <th>KVK / BTW</th>
                <th>Bank account</th>
                <th>
                    <a href="?sort=delivery_time_days&order=<?= $newOrder ?>">
                        Delivery time <?= $currentSort === 'delivery_time_days' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="?sort=supplier_rating&order=<?= $newOrder ?>">
                        Rating <?= $currentSort === 'supplier_rating' ? ($newOrder === 'ASC' ? '↓' : '↑') : '' ?>
                    </a>
                </th>
                <th>Status</th>
                <th>Notes</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
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
                    <td>
                        <a href="suppliers.php?action=edit&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="suppliers.php?action=delete&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>