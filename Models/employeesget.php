<?php
require_once __DIR__ . "/config.php";

// Simple model for employee database operations
class Employee
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function all(string $sort = 'newest'): array
    {
        // Get all employees ordered by creation date
        $orderBy = ($sort === 'oldest') ? 'created_at ASC' : 'created_at DESC';
        
        $sql = "SELECT employee_id, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes, created_at, updated_at FROM employees ORDER BY " . $orderBy;
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        // Find one employee by id
        $sql = "SELECT employee_id, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes, created_at, updated_at FROM employees WHERE employee_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $employee = $stmt->fetch(PDO::FETCH_ASSOC);
        return $employee ?: null;
    }

    public function search(string $searchTerm): array
    {
        // Search employees by name or location fields
        $sql = "SELECT employee_id, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes, created_at, updated_at FROM employees WHERE first_name LIKE :search OR last_name LIKE :search OR job_title LIKE :search OR street LIKE :search OR postal_code LIKE :search OR city LIKE :search ORDER BY employee_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO employees (first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes, created_at, updated_at)
                VALUES (:first_name, :last_name, :email, :phone, :job_title, :department, :hire_date, :salary, :birth_date, :street, :house_number, :postal_code, :city, :country, :contract_type, :employment_status, :emergency_contact_name, :emergency_contact_phone, :notes, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':job_title', $data['job_title'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':department', $data['department'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':hire_date', $data['hire_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':salary', $data['salary'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $data['birth_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':contract_type', $data['contract_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':employment_status', $data['employment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_contact_name', $data['emergency_contact_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_contact_phone', $data['emergency_contact_phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':notes', $data['notes'] ?? null, PDO::PARAM_STR);
        $stmt->execute();

        return (int)$this->conn->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE employees SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, job_title = :job_title, department = :department, hire_date = :hire_date, salary = :salary, birth_date = :birth_date, street = :street, house_number = :house_number, postal_code = :postal_code, city = :city, country = :country, contract_type = :contract_type, employment_status = :employment_status, emergency_contact_name = :emergency_contact_name, emergency_contact_phone = :emergency_contact_phone, notes = :notes, updated_at = NOW() WHERE employee_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':job_title', $data['job_title'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':department', $data['department'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':hire_date', $data['hire_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':salary', $data['salary'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $data['birth_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':contract_type', $data['contract_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':employment_status', $data['employment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_contact_name', $data['emergency_contact_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_contact_phone', $data['emergency_contact_phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':notes', $data['notes'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
