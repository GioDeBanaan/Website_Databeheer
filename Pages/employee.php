<?php
    require_once "../Models/config.php";
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title> Employees </title>
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
                    <a href="employee.php" class="navbar-brand"> Employees</a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="nav-link"> Suppliers</a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link"> Transactions</a>
                </li>
            </ul>
        </header>
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
<<<<<<< HEAD
                <th>Update</th>
                <th>Delete</th>
=======
                <th>Actions</th>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
            </tr>
            
            <?php
                while ($row = $employeeresult->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>". $row["first_name"] . " " . $row["last_name"] . "</td>";
                    echo "<td>" . $row["email"] . "<br>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["job_title"] . "<br><small class='text-muted'>" . $row["department"] . "</small></td>";
                    echo "<td class='text-nowrap'>" . $row["hire_date"] . "</td>";
                    echo "<td>" . "€" . $row["salary"] . "</td>";
                    echo "<td class='text-nowrap'>" . $row["birth_date"] . "</td>";
                    echo "<td class='text-nowrap'>" . $row["street"] . " " . $row["house_number"] . "<br>" . $row["postal_code"] . " <br> <small class='text-muted'>" . $row["city"] . "</small></td>";
                    echo "<td>" . $row["contract_type"] . "</td>";
                    echo "<td>" . $row["employment_status"] . "</td>";
                    echo "<td class='text-nowrap'>". $row["emergency_contact_name"]. "<br>". $row["emergency_contact_phone"]. "</td>";                   
                    echo "<td>" . $row["notes"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["updated_at"] . "</td>";
<<<<<<< HEAD
                    echo "<td><a href=\"../Create/employeEdit.php?employee_id=" . $row["employee_id"] . "\" class=\"btn btn-sm btn-primary\">Edit</a></td>";
                    echo "<td><a href=\"../Delete/employeeDelete.php?employee_id=" . $row["employee_id"] . "\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a></td>";
=======
                    echo "<td><a href=\"../Delete/employeedelete.php?employee_id=" . $row["employee_id"] . "\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a></td>";
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>
