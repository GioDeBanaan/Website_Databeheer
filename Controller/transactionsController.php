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

        header("Location: transactions.php");
        exit();
    }

    private function getFormData(): array
    {
        return [
            'transaction_id' => $_POST['transaction_id'],
            'transaction_code' => $_POST['transaction_code'],
            'transaction_type' => $_POST['transaction_type'],
            'customer_id' => $_POST['customer_id'],
            'supplier_id' => $_POST['supplier_id'],
            'employee_id' => $_POST['employee_id'],
            'game_id' => $_POST['game_id'],
            'transaction_date' => $_POST['transaction_date'],
            'quantity' => $_POST['quantity'],
            'unit_price' => $_POST['unit_price'],
            'discount_percent' => $_POST['discount_percent'],
            'tax_percent' => $_POST['tax_percent'],
            'payment_method' => $_POST['payment_method'],
            'payment_status' => $_POST['payment_status'],
            'order_status' => $_POST['order_status'],
            'created_at' => $_POST['created_at'],
            'updated_at' => $_POST['updated_at']
        ];
    }
}