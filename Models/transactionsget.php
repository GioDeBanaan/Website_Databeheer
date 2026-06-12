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
        // Added LEFT JOINs so your dashboard displays supplier and game names instead of raw IDs
        $sql = "SELECT 
                    t.transaction_id, 
                    t.transaction_code, 
                    t.transaction_type, 
                    t.customer_name, 
                    s.company_name AS company, 
                    g.title AS game_name, 
                    t.transaction_date, 
                    t.quantity, 
                    t.unit_price, 
                    t.discount_percent, 
                    t.tax_percent, 
                    t.payment_method, 
                    t.payment_status, 
                    t.order_status, 
                    t.created_at, 
                    t.updated_at 
                FROM transactions t
                LEFT JOIN suppliers s ON t.company = s.supplier_id
                LEFT JOIN games g ON t.game_name = g.game_id
                ORDER BY t.transaction_id DESC";
                
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        // Added LEFT JOINs here too so viewing a single transaction shows readable data
        $sql = "SELECT 
                    t.transaction_id, 
                    t.transaction_code, 
                    t.transaction_type, 
                    t.customer_name, 
                    s.company_name AS company, 
                    g.title AS game_name, 
                    t.transaction_date, 
                    t.quantity, 
                    t.unit_price, 
                    t.discount_percent, 
                    t.tax_percent, 
                    t.payment_method, 
                    t.payment_status, 
                    t.order_status, 
                    t.created_at, 
                    t.updated_at 
                FROM transactions t
                LEFT JOIN suppliers s ON t.company = s.supplier_id
                LEFT JOIN games g ON t.game_name = g.game_id
                WHERE t.transaction_id = :id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
        return $transaction ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO transactions (transaction_type, customer_name, company, game_name, transaction_date, quantity, unit_price, discount_percent, tax_percent, payment_method, payment_status, order_status, created_at, updated_at)
                VALUES (:transaction_type, :customer_name, :company, :game_name, :transaction_date, :quantity, :unit_price, :discount_percent, :tax_percent, :payment_method, :payment_status, :order_status, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':transaction_type', $data['transaction_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_name', $data['customer_name'] ?? null, PDO::PARAM_STR);
        // Fixed case-sensitivity issue: changing $data['Company'] to $data['company'] matches standard form naming rules
        $stmt->bindValue(':company', $data['company'] ?? $data['Company'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':game_name', $data['game_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':transaction_date', $data['transaction_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $data['unit_price'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':discount_percent', $data['discount_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':tax_percent', $data['tax_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $data['payment_method'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_status', $data['payment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':order_status', $data['order_status'] ?? null, PDO::PARAM_STR);

        $stmt->execute();

        return (int)$this->conn->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE transactions SET transaction_type = :transaction_type, customer_name = :customer_name, company = :company, game_name = :game_name, transaction_date = :transaction_date, quantity = :quantity, unit_price = :unit_price, discount_percent = :discount_percent, tax_percent = :tax_percent, payment_method = :payment_method, payment_status = :payment_status, order_status = :order_status, updated_at = NOW() WHERE transaction_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':transaction_type', $data['transaction_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_name', $data['customer_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':company', $data['company'] ?? $data['Company'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':game_name', $data['game_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':transaction_date', $data['transaction_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $data['unit_price'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':discount_percent', $data['discount_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':tax_percent', $data['tax_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $data['payment_method'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_status', $data['payment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':order_status', $data['order_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}