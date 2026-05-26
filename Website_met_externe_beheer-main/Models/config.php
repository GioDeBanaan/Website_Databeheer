<?php

    $host = "localhost";
    $dbname = "gamevault";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $username,
            $password
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        die("Databaseverbinding mislukt: " . $e->getMessage());
    }

    // Ik heb hier AS gebruikt omdat ik hier twee names heb eentje voor de genre en de ander voor het platform
    //ik heb hier join gebruik omdat ik van meerdere databases dingen moet halen en op eentje mergen

    $sql = "SELECT employee_id, employee_number, first_name, last_name, email, phone, job_title, department, hire_date, salary, birth_date, street, house_number, postal_code, city, country, contract_type, employment_status, emergency_contact_name, emergency_contact_phone, notes, created_at, updated_at FROM employees ORDER BY employee_id DESC";

    $employeeresult = $conn->query($sql);

    $sql = "SELECT genre_id, name FROM genres ORDER BY genre_id DESC";

    $genreresult = $conn->query($sql);

    $sql = "SELECT platform_id, name FROM platforms ORDER BY platform_id DESC";

    $platformresult = $conn->query($sql);

    $sql = "SELECT  supplier_id, supplier_code, company_name, contact_person, email, phone, website, chamber_of_commerce_number, vat_number, street, house_number, postal_code, city, country, bank_account, delivery_time_days, supplier_rating, is_active, notes, created_at, updated_at FROM suppliers ORDER BY supplier_id DESC";

    $supplierresult = $conn->query($sql);
    // concat is als je twee of meer dingen in een wil hebben zoals hier wil ik voor en achternaam samen dit is effe een reminder voor kai

    $sql = "SELECT t.transaction_id, t.transaction_code, t.transaction_type,  CONCAT(c.first_name, ' ', c.last_name) AS customer_name, s.company_name AS supplier_name, g.title AS game_title, t.transaction_date, t.quantity, t.unit_price, t.discount_percent, t.tax_percent, t.payment_method, t.payment_status, t.order_status, t.shipping_address, t.billing_address, t.reference_note, t.notes, t.created_at, t.updated_at FROM transactions t LEFT JOIN customers c ON t.customer_id = c.customer_id LEFT JOIN suppliers s ON t.supplier_id = s.supplier_id LEFT JOIN games g ON t.game_id = g.game_id ORDER BY t.transaction_id DESC";

    $transactionresult = $conn->query($sql);


?>