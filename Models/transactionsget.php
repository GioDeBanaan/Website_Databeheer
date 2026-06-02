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
    // Added employee_id and supplier_id to the SELECT list below:
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

    // ADD THIS NEW METHOD CODE HERE:
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

        return $stmt->execute([
            ':transaction_code' => $data['transaction_code'],
            ':transaction_type' => $data['transaction_type'],
            ':customer_id'     => $data['customer_id'],
            ':supplier_id'     => $data['supplier_id'],
            ':employee_id'     => $data['employee_id'],
            ':game_id'         => $data['game_id'],
            ':transaction_date'=> $data['transaction_date'],
            ':quantity'         => $data['quantity'],
            ':unit_price'       => $data['unit_price'],
            ':discount_percent'=> $data['discount_percent'],
            ':tax_percent'     => $data['tax_percent'],
            ':payment_method'   => $data['payment_method'],
            ':payment_status'   => $data['payment_status'],
            ':order_status'     => $data['order_status']
        ]);
    }
}
