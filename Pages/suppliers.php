<?php
    require_once "../Models/config.php";
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title> Suppliers </title>
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
                    <a href="customers.php" class="nav-link"> Customers</a>
                </li>
                <li class="nav-item">
                    <a href="employee.php" class="nav-link"> Employees</a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="navbar-brand"> Suppliers</a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link"> Transactions</a>
                </li>
            </ul>
        </header>
        <table class="table table-bordered">
            <tr>
                <th>Contact</th>
                <th>Chamber of commerce</th>
                <th>VAT number</th>
                <th>Address</th>
                <th>Bank account</th>
                <th>Delivery time</th>
                <th>Supplier rating</th>
                <th>Active</th>
                <th>Notes</th>
                <th>Created at</th>
                <th>Last updated at</th>
            </tr>
            <?php
                while ($row = $supplierresult->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["company_name"] . "<br>" . $row["contact_person"] . "<br>" . $row["email"] . " " . $row["phone"] . "<br>" . $row["website"] . "</td>";
                    echo "<td>" . $row["chamber_of_commerce_number"] . "</td>";
                    echo "<td>" . $row["vat_number"] . "</td>";
                    echo "<td>" . $row["street"] . " " . $row["house_number"] . "<br>" . $row["postal_code"] . " " . $row["city"] . "<br>" . $row["country"] . "</td>";
                    echo "<td>" . $row["bank_account"] . "</td>";
                    echo "<td>" . $row["delivery_time_days"] . "</td>";
                    echo "<td>" . $row["supplier_rating"] . "</td>";;
                    echo "<td>" . $row["is_active"] . "</td>";
                    echo "<td>" . $row["notes"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["updated_at"] . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>