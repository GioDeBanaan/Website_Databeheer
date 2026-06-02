<?php
    if (!isset($customerresult)) {
        die("customerresult not passed to view");
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title> Customers </title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class=" navbar-nav ">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link">Home </a>
                </li>
                <li class="nav-item">
                    <a href="gamelist.php" class="nav-link"> Game list</a>
                </li>
                <li class="nav-item">
                    <a href="customers.php" class="navbar-brand"> Customers</a>
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
            <a href="../Create/customersCreate.php" class="btn btn-success mb-3">Add new customer</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of birth</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Registration date</th>
                <th>Customer status</th>
                <th>Loyalty points</th>
                <th>Newsletter status</th>
                <th>Created at</th>
                <th>Last updated at</th>
            </tr>
            <?php foreach ($customerresult as $customer):?>
                <tr>
                    <td><?= htmlspecialchars($customer["first_name"]) ?> <?= htmlspecialchars($customer["last_name"]) ?></td>
                    <td><?= htmlspecialchars($customer["gender"]) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($customer["date_of_birth"]) ?></td>
                    <td><?= htmlspecialchars($customer["email"]) ?><br><?= htmlspecialchars($customer["phone"]) ?></td>
                    <td class="text-nowrap"><?= htmlspecialchars($customer["street"]) ?> <?= htmlspecialchars($customer["house_number"]) ?><br><?= htmlspecialchars($customer["postal_code"]) ?> <?= "<br> <small class=\"text-muted\">".htmlspecialchars($customer["city"])."</small><br> <small class=\"text-muted\">".htmlspecialchars($customer["country"]) ?></td>
                    <td><?= htmlspecialchars($customer["registration_date"]) ?></td>
                    <td><?= htmlspecialchars($customer["customer_status"]) ?></td>
                    <td><?= htmlspecialchars($customer["loyalty_points"]) ?></td>
                    <td><?= $customer["newsletter_subscribed"] == 1 ? 'Yes' : ($customer["newsletter_subscribed"] == 0 ? 'No' : htmlspecialchars($customer["newsletter_subscribed"])) ?></td>
                    <td><?= htmlspecialchars($customer["created_at"]) ?></td>
                    <td><?= htmlspecialchars($customer["updated_at"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
