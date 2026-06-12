<?php
require_once __DIR__ . "/../Models/config.php";
global $conn;

// Handle employee creation form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
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

    $insert = $conn->prepare('INSERT INTO employees (first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes) VALUES (:first_name, :last_name, :email, :phone, :job_title, :department, :hire_date, :salary, :birth_date, :street, :house_number, :postal_code, :city, :country, :contract_type, :employment_status, :emergency_contact_name, :emergency_contact_phone, :notes)');
    $insert->execute($data);

    // Redirect back to employee page after successful insert
    header('Location: ../Pages/employee.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Add new employee</title>
    </head>
    <body>
        <div class="container mt-4">
            <h1>Add new employee</h1>
            <?php
                // Ensure $employee is defined for the form partial
                $employee = $employee ?? [
                    'first_name'=>'','last_name'=>'','email'=>'','phone'=>'','job_title'=>'','department'=>'','hire_date'=>'','salary'=>'','birth_date'=>'','street'=>'','house_number'=>'','postal_code'=>'','city'=>'','country'=>'','contract_type'=>'','employment_status'=>'','emergency_contact_name'=>'','emergency_contact_phone'=>'','notes'=>''
                ];
                $submitLabel = 'Add employee';
                include __DIR__ . '/employeeForm.php';
            ?>
        </div>
    </body>
</html>
