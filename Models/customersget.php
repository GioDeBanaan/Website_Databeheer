<?php
require_once __DIR__ . "/config.php";

class Customer
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function all(string $sort = 'newest'): array
    {
        $orderBy = ($sort === 'oldest') ? 'created_at ASC' : 'created_at DESC';
        
        $sql = "SELECT customer_id, first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed, created_at, updated_at FROM customers ORDER BY " . $orderBy;
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT customer_id, first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed, created_at, updated_at FROM customers WHERE customer_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        return $customer ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO customers (first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed, created_at, updated_at)
                VALUES (:first_name, :last_name, :gender, :date_of_birth, :email, :phone, :street, :house_number, :postal_code, :city, :country, :registration_date, :customer_status, :loyalty_points, :newsletter_subscribed, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $data['gender'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth', $data['date_of_birth'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $data['registration_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_status', $data['customer_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':loyalty_points', isset($data['loyalty_points']) ? (int)$data['loyalty_points'] : 0, PDO::PARAM_INT);
        $stmt->bindValue(':newsletter_subscribed', isset($data['newsletter_subscribed']) ? $data['newsletter_subscribed'] : 0, PDO::PARAM_INT);

        $stmt->execute();

        return (int)$this->conn->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE customers SET first_name = :first_name, last_name = :last_name, gender = :gender, date_of_birth = :date_of_birth, email = :email, phone = :phone, street = :street, house_number = :house_number, postal_code = :postal_code, city = :city, country = :country, registration_date = :registration_date, customer_status = :customer_status, loyalty_points = :loyalty_points, newsletter_subscribed = :newsletter_subscribed, updated_at = NOW() WHERE customer_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $data['gender'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth', $data['date_of_birth'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $data['registration_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_status', $data['customer_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':loyalty_points', isset($data['loyalty_points']) ? (int)$data['loyalty_points'] : 0, PDO::PARAM_INT);
        $stmt->bindValue(':newsletter_subscribed', isset($data['newsletter_subscribed']) ? $data['newsletter_subscribed'] : 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
        public function search(string $Searchterm) : array
    {
        $sql = "SELECT first_name, last_name, date_of_birth, gender, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed, created_at, updated_at FROM customers WHERE first_name LIKE :Searchterm OR last_name LIKE :Searchterm OR email LIKE :Searchterm OR city LIKE :Searchterm";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['Searchterm' => "%" . $Searchterm . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}