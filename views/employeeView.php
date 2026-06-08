<?php
if (!isset($employeeresult)) {
    die("employeeresult not passed to view");
}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Employees</title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="gamelist.php" class="nav-link">Game list</a>
                </li>
                <li class="nav-item">
                    <a href="customers.php" class="nav-link">Customers</a>
                </li>
                <li class="nav-item">
                    <a href="employee.php" class="navbar-brand">Employees</a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="nav-link">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link">Transactions</a>
                </li>
            </ul>
        </header>

        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="employee.php" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Search employees..." value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="employee.php?action=create" class="btn btn-success">Add new employee</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Job title</th>
                <th>Hire date</th>
                <th>Salary</th>
                <th>Birth date</th>
                <th>Address</th>
                <th>Contract type</th>
                <th>Employment status</th>
                <th>Emergency contact</th>
                <th>Notes</th>
                <th>Created at</th>
                <th>Last updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($employeeresult as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?><br><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['job_title']) ?><br><small class="text-muted"><?= htmlspecialchars($row['department']) ?></small></td>
                    <td class="text-nowrap"><?= htmlspecialchars($row['hire_date']) ?></td>
                    <td>€<?= htmlspecialchars($row['salary']) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($row['birth_date']) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($row['street'] . ' ' . $row['house_number']) ?><br><?= htmlspecialchars($row['postal_code']) ?><br><small class="text-muted"><?= htmlspecialchars($row['city']) ?></small></td>
                    <td><?= htmlspecialchars($row['contract_type']) ?></td>
                    <td><?= htmlspecialchars($row['employment_status']) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($row['emergency_contact_name']) ?><br><?= htmlspecialchars($row['emergency_contact_phone']) ?></td>
                    <td><?= htmlspecialchars($row['notes']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td><?= htmlspecialchars($row['updated_at']) ?></td>
                    <td><a href="employee.php?action=edit&id=<?= $row['employee_id'] ?>" class="btn btn-primary">Edit</a></td>
                    <td><a href="../Delete/employeeDelete.php?employee_id=<?= $row['employee_id'] ?>" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze werknemer wilt verwijderen?');">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
