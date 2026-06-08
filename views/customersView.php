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
    <body id="top">
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
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="customers.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search customers..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? 'newest') ?>">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="customers.php?sort=newest" class="btn btn-outline-secondary <?= (($_GET['sort'] ?? 'newest') === 'newest') ? 'active' : '' ?>">Newest</a>
                    <a href="customers.php?sort=oldest" class="btn btn-outline-secondary <?= (($_GET['sort'] ?? 'newest') === 'oldest') ? 'active' : '' ?>">Oldest</a>
                    <a href="../Create/customersCreate.php" class="btn btn-success">Add new customer</a>
                </div>
            </div>
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
                <th>Edit</th>
                <th>Delete</th>
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
                    <td><a href="../Create/customersEdit.php?id=<?= htmlspecialchars($customer["customer_id"]) ?>" class="btn btn-primary">Edit</a></td>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?= $customer['customer_id'] ?>, '<?= htmlspecialchars(addslashes($customer['first_name'] . ' ' . $customer['last_name'])) ?>', '<?= htmlspecialchars(addslashes($customer['email'] ?? '')) ?>')">Delete</button></td>
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
        let deleteCustomerId = null;

        function setDeleteData(customerId, customerTitle) {
            deleteCustomerId = customerId;
            document.getElementById('deleteTitle').textContent = customerTitle;
        }

        function confirmDelete() {
            if (deleteCustomerId) {
                window.location.href = '../Delete/customersDelete.php?id=' + deleteCustomerId;
            }
        }
    </script>
        <div class="justify-content-center d-flex mb-4">
        <a href="#top" class="btn btn-outline-warning scroll-to-top">Back to Top</a>
    </div>
    </body>
</html>
