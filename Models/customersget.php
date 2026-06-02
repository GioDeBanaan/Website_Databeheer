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

    public function all(): array
    {
<<<<<<< HEAD
            $sql = "SELECT customer_id,  first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed, created_at, updated_at FROM customers ORDER BY customer_id DESC";
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
                VALUES (:first_name, :last_name, :gender, :date_of_birth, :email, :phone, :street, :house_number, :postal_code, :city, :country, NOW(), 'Active', 0, 0, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':gender', $data['gender'], PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'], PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'], PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'], PDO::PARAM_STR);

        $stmt->execute();
        return (int)$this->conn->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE customers
                SET first_name = :first_name,
                    last_name = :last_name,
                    gender = :gender,
                    date_of_birth = :date_of_birth,
                    email = :email,
                    phone = :phone,
                    street = :street,
                    house_number = :house_number,
                    postal_code = :postal_code,
                    city = :city,
                    country = :country,
                    updated_at = NOW()
                WHERE customer_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':gender', $data['gender'], PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth', $data['date_of_birth'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'], PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'], PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
    private function getPrimaryId(array $ids): ?int
    {
        return count($ids) > 0 ? $ids[0] : null;
    }


=======
            $sql = "SELECT customer_id, customer_code, first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed,  created_at, updated_at FROM customers ORDER BY customer_id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
}