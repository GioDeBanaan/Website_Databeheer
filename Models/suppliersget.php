<?php
require_once __DIR__ . "/config.php";

class Suppliers
{
    private PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function all(string $sort = 'supplier_id', string $order = 'DESC', int $page = 1, int $perPage = 10): array
    {
        $allowedSorts = ['supplier_id', 'supplier_code', 'company_name', 'contact_person', 'delivery_time_days', 'supplier_rating'];
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array($sort, $allowedSorts)) $sort = 'supplier_id';
        if (!in_array($order, $allowedOrders)) $order = 'DESC';

        $offset = max(0, ($page - 1) * $perPage);

        $sql = "SELECT supplier_id, supplier_code, company_name, contact_person, email, phone, website,
                       chamber_of_commerce_number, vat_number, street, house_number, postal_code, city,
                       country, bank_account, delivery_time_days, supplier_rating, is_active, notes,
                       created_at, updated_at
                FROM suppliers
                ORDER BY $sort $order
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll(): int
    {
        return (int) $this->conn->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
    }

    public function search(string $searchterm, string $sort = 'supplier_id', string $order = 'DESC', int $page = 1, int $perPage = 10): array
    {
        $allowedSorts = ['supplier_id', 'supplier_code', 'company_name', 'contact_person', 'delivery_time_days', 'supplier_rating'];
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array($sort, $allowedSorts)) $sort = 'supplier_id';
        if (!in_array($order, $allowedOrders)) $order = 'DESC';

        $offset = max(0, ($page - 1) * $perPage);

        $sql = "SELECT supplier_id, supplier_code, company_name, contact_person, email, phone, website,
                       chamber_of_commerce_number, vat_number, street, house_number, postal_code, city,
                       country, bank_account, delivery_time_days, supplier_rating, is_active, notes,
                       created_at, updated_at
                FROM suppliers
                WHERE supplier_id LIKE :search
                   OR supplier_code LIKE :search
                   OR company_name LIKE :search
                   OR contact_person LIKE :search
                   OR email LIKE :search
                   OR city LIKE :search
                   OR country LIKE :search
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
        $sql = "SELECT COUNT(*) FROM suppliers
                WHERE supplier_id LIKE :search
                   OR supplier_code LIKE :search
                   OR company_name LIKE :search
                   OR contact_person LIKE :search
                   OR email LIKE :search
                   OR city LIKE :search
                   OR country LIKE :search";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $searchterm . '%', PDO::PARAM_STR);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT supplier_id, supplier_code, company_name, contact_person, email, phone, website,
                       chamber_of_commerce_number, vat_number, street, house_number, postal_code, city,
                       country, bank_account, delivery_time_days, supplier_rating, is_active, notes,
                       created_at, updated_at
                FROM suppliers
                WHERE supplier_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
        return $supplier ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO suppliers (supplier_code, company_name, contact_person, email, phone, website,
                                       chamber_of_commerce_number, vat_number, street, house_number, postal_code,
                                       city, country, bank_account, delivery_time_days, supplier_rating, is_active, notes)
                VALUES (:supplier_code, :company_name, :contact_person, :email, :phone, :website,
                        :chamber_of_commerce_number, :vat_number, :street, :house_number, :postal_code,
                        :city, :country, :bank_account, :delivery_time_days, :supplier_rating, :is_active, :notes)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':supplier_code', $data['supplier_code'], PDO::PARAM_STR);
        $stmt->bindValue(':company_name', $data['company_name'], PDO::PARAM_STR);
        $stmt->bindValue(':contact_person', $data['contact_person'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':website', $data['website'], PDO::PARAM_STR);
        $stmt->bindValue(':chamber_of_commerce_number', $data['chamber_of_commerce_number'], PDO::PARAM_STR);
        $stmt->bindValue(':vat_number', $data['vat_number'], PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'], PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'], PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'], PDO::PARAM_STR);
        $stmt->bindValue(':bank_account', $data['bank_account'], PDO::PARAM_STR);
        $stmt->bindValue(':delivery_time_days', $data['delivery_time_days'], PDO::PARAM_INT);
        $stmt->bindValue(':supplier_rating', $data['supplier_rating'], PDO::PARAM_STR);
        $stmt->bindValue(':is_active', $data['is_active'], PDO::PARAM_INT);
        $stmt->bindValue(':notes', $data['notes'], PDO::PARAM_STR);
        $stmt->execute();
        return (int)$this->conn->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE suppliers
                SET supplier_code = :supplier_code,
                    company_name = :company_name,
                    contact_person = :contact_person,
                    email = :email,
                    phone = :phone,
                    website = :website,
                    chamber_of_commerce_number = :chamber_of_commerce_number,
                    vat_number = :vat_number,
                    street = :street,
                    house_number = :house_number,
                    postal_code = :postal_code,
                    city = :city,
                    country = :country,
                    bank_account = :bank_account,
                    delivery_time_days = :delivery_time_days,
                    supplier_rating = :supplier_rating,
                    is_active = :is_active,
                    notes = :notes
                WHERE supplier_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':supplier_code', $data['supplier_code'], PDO::PARAM_STR);
        $stmt->bindValue(':company_name', $data['company_name'], PDO::PARAM_STR);
        $stmt->bindValue(':contact_person', $data['contact_person'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':website', $data['website'], PDO::PARAM_STR);
        $stmt->bindValue(':chamber_of_commerce_number', $data['chamber_of_commerce_number'], PDO::PARAM_STR);
        $stmt->bindValue(':vat_number', $data['vat_number'], PDO::PARAM_STR);
        $stmt->bindValue(':street', $data['street'], PDO::PARAM_STR);
        $stmt->bindValue(':house_number', $data['house_number'], PDO::PARAM_STR);
        $stmt->bindValue(':postal_code', $data['postal_code'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindValue(':country', $data['country'], PDO::PARAM_STR);
        $stmt->bindValue(':bank_account', $data['bank_account'], PDO::PARAM_STR);
        $stmt->bindValue(':delivery_time_days', $data['delivery_time_days'], PDO::PARAM_INT);
        $stmt->bindValue(':supplier_rating', $data['supplier_rating'], PDO::PARAM_STR);
        $stmt->bindValue(':is_active', $data['is_active'], PDO::PARAM_INT);
        $stmt->bindValue(':notes', $data['notes'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM suppliers WHERE supplier_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}