<?php
require_once "../Models/config.php";

if (!isset($_GET['employee_id'])) {
    header('Location: ../Pages/employee.php');
    exit;
}

$employee_id = (int)$_GET['employee_id'];

$stmt = $conn->prepare('SELECT employee_id, employee_number, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes FROM employees WHERE employee_id = :employee_id');
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
            <form method="post" action="">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label class="form-label">First name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee['first_name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee['last_name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee['email']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($employee['phone']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Job title</label>
                        <input type="text" name="job_title" class="form-control" value="<?= htmlspecialchars($employee['job_title']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($employee['department']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Hire date</label>
                        <input type="date" name="hire_date" class="form-control" value="<?= htmlspecialchars($employee['hire_date']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Salary</label>
                        <input type="number" step="0.01" name="salary" class="form-control" value="<?= htmlspecialchars($employee['salary']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Birth date</label>
                        <input type="date" name="birth_date" class="form-control" value="<?= htmlspecialchars($employee['birth_date']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($employee['street']) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">House number</label>
                        <input type="text" name="house_number" class="form-control" value="<?= htmlspecialchars($employee['house_number']) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Postal code</label>
                        <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars($employee['postal_code']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($employee['city']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($employee['country']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Contract type</label>
                        <input type="text" name="contract_type" class="form-control" value="<?= htmlspecialchars($employee['contract_type']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Employment status</label>
                        <input type="text" name="employment_status" class="form-control" value="<?= htmlspecialchars($employee['employment_status']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency contact name</label>
                        <input type="text" name="emergency_contact_name" class="form-control" value="<?= htmlspecialchars($employee['emergency_contact_name']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency contact phone</label>
                        <input type="text" name="emergency_contact_phone" class="form-control" value="<?= htmlspecialchars($employee['emergency_contact_phone']) ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($employee['notes']) ?></textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <a href="../Pages/employee.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </body>
</html>
