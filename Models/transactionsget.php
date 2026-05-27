<?php
require_once __DIR__ . "/config.php";

class Transaction
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function all(): array
    {
            $sql = "SELECT transaction_id, transaction_code, transaction_type, customer_id, supplier_id, employee_id, game_id, transaction_date, quantity, unit_price, discount_percent, tax_percent, payment_method, payment_status, order_status, created_at, updated_at FROM transactions ORDER BY transaction_id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}