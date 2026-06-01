<?php

require_once __DIR__ . '/../Models/config.php';
// Check if employee_id parameter exists
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

// SQL Delete statement to delete employee from database
    $sql = "DELETE FROM employees WHERE employee_id = :employee_id";

// execute the delete statement with parameterized query to prevent SQL injection
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':employee_id' => $employee_id
        ]);

        header('Location: ../Pages/employee.php?status=succesdel');
        exit;
    } catch (PDOException $e) {
        echo 'Fout: ' . $e->getMessage();
        exit;
    }
}

header('Location: ../Pages/employee.php?status=fail');
exit;
