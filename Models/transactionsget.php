<?php
require_once __DIR__ . "/config.php";

<<<<<<< HEAD
class transaction
=======
class Transaction
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
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
            $sql = "SELECT transaction_id, transaction_code, transaction_type, customer_id, employee_id, game_id, transaction_date, quantity, unit_price, discount_percent, tax_percent, payment_method, payment_status, order_status, shipping_address, billing_address, reference_note, notes, created_at, updated_at FROM transactions ORDER BY transaction_id DESC";
=======
            $sql = "SELECT transaction_id, transaction_code, transaction_type, customer_id, supplier_id, employee_id, game_id, transaction_date, quantity, unit_price, discount_percent, tax_percent, payment_method, payment_status, order_status, created_at, updated_at FROM transactions ORDER BY transaction_id DESC";
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}