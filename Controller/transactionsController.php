<?php

require_once __DIR__ . '/../Models/transactionsget.php';

class TransactionsController
{
    private Transaction $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function index(): void
    {
        $transactionresults = $this->transaction->all();

        require __DIR__ . '/../views/transactionsView.php';
    }
  
public function store(): void
{
    $this->transaction->create($this->getFormData());
    
    header("Location: ../Pages/transactions.php?action=index");
    exit();
}


private function getFormData(): array
{
    if (!isset($_POST['transaction_code'])) {
        echo "<pre>CRITICAL: PHP cannot find 'transaction_code' in the submitted form.\n";
        echo "Here is what PHP actually received:\n";
        print_r($_POST);
        echo "</pre>";
        die();
    }

    return [
        'transaction_code' => trim($_POST['transaction_code']),
        'transaction_type' => $_POST['transaction_type'] ?? null,
        
        // Ensure IDs are cast to integers or set to null if empty
        'customer_id'      => !empty($_POST['customer_id']) ? (int)$_POST['customer_id'] : null,
        'supplier_id'      => !empty($_POST['supplier_id']) ? (int)$_POST['supplier_id'] : null,
        'employee_id'      => !empty($_POST['employee_id']) ? (int)$_POST['employee_id'] : null,
        'game_id'          => !empty($_POST['game_id']) ? (int)$_POST['game_id'] : null,
        
        'transaction_date' => $_POST['transaction_date'] ?? null,
        'quantity'         => !empty($_POST['quantity']) ? (int)$_POST['quantity'] : 0,
        'unit_price'       => $_POST['unit_price'] ?? '0.00',
        'discount_percent' => $_POST['discount_percent'] ?? '0.00',
        'tax_percent'      => $_POST['tax_percent'] ?? '0.00',
        'payment_method'   => $_POST['payment_method'] ?? null,
        
        // Clean up text states to ensure lowercase database compatibility
        'payment_status'   => isset($_POST['payment_status']) ? strtolower(trim($_POST['payment_status'])) : null,
        'order_status'     => isset($_POST['order_status']) ? strtolower(trim($_POST['order_status'])) : null,
    ];
}
}
