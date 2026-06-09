<!-- 08/06/2026 made by: Gio-->

<?php
require_once __DIR__ . "/../Models/config.php";
global $conn;

// Requires employee id to edit
if (!isset($_GET['employee_id'])) {
    header('Location: ../Pages/employee.php');
    exit;
}

$employee_id = (int)$_GET['employee_id'];

$stmt = $conn->prepare('SELECT employee_id, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes FROM employees WHERE employee_id = :employee_id');
$stmt->execute(['employee_id' => $employee_id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    header('Location: ../Pages/employee.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'employee_id' => $employee_id,
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'job_title' => trim($_POST['job_title'] ?? ''),
        'department' => trim($_POST['department'] ?? ''),
        'hire_date' => trim($_POST['hire_date'] ?? ''),
        'salary' => trim($_POST['salary'] ?? ''),
        'birth_date' => trim($_POST['birth_date'] ?? ''),
        'street' => trim($_POST['street'] ?? ''),
        'house_number' => trim($_POST['house_number'] ?? ''),
        'postal_code' => trim($_POST['postal_code'] ?? ''),
        'city' => trim($_POST['city'] ?? ''),
        'country' => trim($_POST['country'] ?? ''),
        'contract_type' => trim($_POST['contract_type'] ?? ''),
        'employment_status' => trim($_POST['employment_status'] ?? ''),
        'emergency_contact_name' => trim($_POST['emergency_contact_name'] ?? ''),
        'emergency_contact_phone' => trim($_POST['emergency_contact_phone'] ?? ''),
        'notes' => trim($_POST['notes'] ?? ''),
    ];

    $update = $conn->prepare('UPDATE employees SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, job_title = :job_title, department = :department, hire_date = :hire_date, salary = :salary, birth_date = :birth_date, street = :street, house_number = :house_number, postal_code = :postal_code, city = :city, country = :country, contract_type = :contract_type, employment_status = :employment_status, emergency_contact_name = :emergency_contact_name, emergency_contact_phone = :emergency_contact_phone, notes = :notes, updated_at = NOW() WHERE employee_id = :employee_id');
    $update->execute($data);

    // After saving, return to employee list
    header('Location: ../Pages/employee.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Edit Employee</title>
    </head>
    <body>
        <div class="container mt-4">
            <h1>Edit Employee</h1>
            <?php
                $submitLabel = 'Save changes';
            // Include the shared employee form partial
            include __DIR__ . '/employeeForm.php';
            ?>
        </div>
    </body>
</html>
