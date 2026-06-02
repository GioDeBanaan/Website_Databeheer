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
            $sql = "SELECT customer_id, first_name, last_name, gender, date_of_birth, email, phone, street, house_number, postal_code, city, country, registration_date, customer_status, loyalty_points, newsletter_subscribed,  created_at, updated_at FROM customers ORDER BY customer_id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}