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

    public function countAll(): int
    {
        $query = "SELECT COUNT(*) FROM transactions";
        // Gefikst: Veranderd van $this->db naar $this->conn
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return (int) $stmt->fetchColumn();
    }

    // Gefikst: Argumenten toegevoegd zodat sortering en paginering (LIMIT/OFFSET) werken
    public function all(string $sort = 'transaction_id', string $order = 'DESC', int $page = 1, int $perPage = 10): array
    {
        $allowedSorts = ['transaction_id', 'transaction_type', 'customer_name', 'company', 'game_name', 'transaction_date', 'quantity', 'unit_price', 'discount_percent', 'tax_percent', 'payment_method', 'payment_status', 'order_status', 'created_at', 'updated_at'];
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array($sort, $allowedSorts)) $sort = 'transaction_id';
        if (!in_array($order, $allowedOrders)) $order = 'DESC';

        $offset = max(0, ($page - 1) * $perPage);

        $sql = "SELECT 
            t.transaction_id,
            t.transaction_type,
            t.customer_name,
            t.company,
            t.game_id,
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
        LEFT JOIN games g ON t.game_id = g.game_id
        ORDER BY $sort $order
        LIMIT :limit OFFSET :offset";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT 
                    t.transaction_id, 
                    t.transaction_type, 
                    t.customer_name, 
                    t.company, 
                    t.game_id,
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
                LEFT JOIN games g ON t.game_id = g.game_id
                WHERE t.transaction_id = :id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
        return $transaction ?: null;
    }

    public function create(array $data): void
    {
        $sql = "INSERT INTO transactions (transaction_type, customer_name, company, game_id, transaction_date, quantity, unit_price, discount_percent, tax_percent, payment_method, payment_status, order_status, created_at, updated_at)
                VALUES (:transaction_type, :customer_name, :company, :game_id, :transaction_date, :quantity, :unit_price, :discount_percent, :tax_percent, :payment_method, :payment_status, :order_status, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':transaction_type', $data['transaction_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_name', $data['customer_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':company', $data['company'] ?? $data['Company'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':game_id', $data['game_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':transaction_date', $data['transaction_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $data['unit_price'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':discount_percent', $data['discount_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':tax_percent', $data['tax_percent'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $data['payment_method'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':payment_status', $data['payment_status'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':order_status', $data['order_status'] ?? null, PDO::PARAM_STR);

        $stmt->execute();
    }
     
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE transactions SET 
                    transaction_type = :transaction_type, 
                    customer_name = :customer_name, 
                    company = :company, 
                    game_id = :game_id, 
                    transaction_date = :transaction_date, 
                    quantity = :quantity, 
                    unit_price = :unit_price, 
                    discount_percent = :discount_percent, 
                    tax_percent = :tax_percent, 
                    payment_method = :payment_method, 
                    payment_status = :payment_status, 
                    order_status = :order_status, 
                    updated_at = NOW() 
                WHERE transaction_id = :id";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':transaction_type', $data['transaction_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':customer_name', $data['customer_name'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':company', $data['company'] ?? $data['Company'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':game_id', $data['game_id'] ?? null, PDO::PARAM_INT);
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

    public function search(string $searchterm, string $sort = 'transaction_id', string $order = 'DESC', int $page = 1, int $perPage = 10): array
    {
        $allowedSorts = ['transaction_id', 'transaction_type', 'customer_name', 'company', 'game_name', 'transaction_date', 'quantity', 'unit_price', 'discount_percent', 'tax_percent', 'payment_method', 'payment_status', 'order_status', 'created_at', 'updated_at'];
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array($sort, $allowedSorts)) $sort = 'transaction_id';
        if (!in_array($order, $allowedOrders)) $order = 'DESC';

        $offset = max(0, ($page - 1) * $perPage);

        $sql = "SELECT t.transaction_id, t.transaction_type, t.customer_name, t.company, t.game_id, g.title AS game_name, t.transaction_date, t.quantity, t.unit_price, t.discount_percent, t.tax_percent, t.payment_method, t.payment_status, t.order_status, t.created_at, t.updated_at
                FROM transactions t
                LEFT JOIN games g ON t.game_id = g.game_id
                WHERE t.transaction_id LIKE :search
                   OR t.transaction_type LIKE :search
                   OR t.customer_name LIKE :search
                   OR t.company LIKE :search
                   OR g.title LIKE :search
                   OR t.transaction_date LIKE :search
                   OR t.quantity LIKE :search
                   OR t.unit_price LIKE :search
                   OR t.discount_percent LIKE :search
                   OR t.tax_percent LIKE :search
                   OR t.payment_method LIKE :search
                   OR t.payment_status LIKE :search
                   OR t.order_status LIKE :search
                ORDER BY $sort $order
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $searchterm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countSearch(string $searchterm): int
    {
        $sql = "SELECT COUNT(*) FROM transactions t
                LEFT JOIN games g ON t.game_id = g.game_id
                WHERE t.transaction_id LIKE :search
                   OR t.transaction_type LIKE :search
                   OR t.customer_name LIKE :search
                   OR t.company LIKE :search
                   OR g.title LIKE :search
                   OR t.transaction_date LIKE :search
                   OR t.quantity LIKE :search
                   OR t.unit_price LIKE :search
                   OR t.discount_percent LIKE :search
                   OR t.tax_percent LIKE :search
                   OR t.payment_method LIKE :search
                   OR t.payment_status LIKE :search
                   OR t.order_status LIKE :search";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $searchterm . '%', PDO::PARAM_STR);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}