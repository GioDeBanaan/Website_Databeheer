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

    public function getTransactionById($id) {
        $sql = "SELECT * FROM transactions WHERE transaction_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO transactions (
            transaction_code, transaction_type, customer_id, supplier_id, employee_id, 
            game_id, transaction_date, quantity, unit_price, discount_percent, 
            tax_percent, payment_method, payment_status, order_status
        ) VALUES (
            :transaction_code, :transaction_type, :customer_id, :supplier_id, :employee_id, 
            :game_id, :transaction_date, :quantity, :unit_price, :discount_percent, 
            :tax_percent, :payment_method, :payment_status, :order_status
        )";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':transaction_code', $data['transaction_code'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':transaction_type', $data['transaction_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_id', $data['customer_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':supplier_id', $data['supplier_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':employee_id', $data['employee_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':game_id', $data['game_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':transaction_date', $data['transaction_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $data['unit_price'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':discount_percent', $data['discount_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':tax_percent', $data['tax_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $data['payment_method'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_status', $data['payment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':order_status', $data['order_status'] ?? null, PDO::PARAM_STR);

        // FIX: Execute the statement and return its boolean outcome
        return $stmt->execute();
    }
}