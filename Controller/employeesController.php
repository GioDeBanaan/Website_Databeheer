<?php
require_once __DIR__ . "/../Models/employeesget.php";

class EmployeesController
{
    private Employee $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        if (!empty(trim($search))) {
            $employeeresult = $this->employee->search(trim($search));
        } else {
            $search = '';
            $employeeresult = $this->employee->all();
        }

        require __DIR__ . '/../views/employeeView.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../Create/employeeCreate.php';
    }

    public function edit(int $id): void
    {
        $_GET['employee_id'] = $id;
        require __DIR__ . '/../Create/employeEdit.php';
    }

    public function store(): void
    {
        $this->employee->create($this->getFormData());
        header('Location: employee.php');
        exit();
    }

    public function update(int $id): void
    {
        $this->employee->update($id, $this->getFormData());
        header('Location: employee.php');
        exit();
    }

    private function getFormData(): array
    {
        return [
            'first_name' => $_POST['first_name'] ?? null,
            'last_name' => $_POST['last_name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'job_title' => $_POST['job_title'] ?? null,
            'department' => $_POST['department'] ?? null,
            'hire_date' => $_POST['hire_date'] ?? null,
            'salary' => $_POST['salary'] ?? null,
            'birth_date' => $_POST['birth_date'] ?? null,
            'street' => $_POST['street'] ?? null,
            'house_number' => $_POST['house_number'] ?? null,
            'postal_code' => $_POST['postal_code'] ?? null,
            'city' => $_POST['city'] ?? null,
            'country' => $_POST['country'] ?? null,
            'contract_type' => $_POST['contract_type'] ?? null,
            'employment_status' => $_POST['employment_status'] ?? null,
            'emergency_contact_name' => $_POST['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $_POST['emergency_contact_phone'] ?? null,
            'notes' => $_POST['notes'] ?? null,
        ];
    }
}
