<?php
    require_once __DIR__ . "/../Models/transactionsget.php";
    class TransactionsController
    {
        private Transaction $transaction;

        public function __construct()
        {
            $this->transaction = new Transaction();
        }

        public function index(): void
        {
            $transactionresult = $this->transaction->all();

        require __DIR__ . '/../views/transactionsView.php';
        }

        // public function create(): void
        // {
        //     require __DIR__ .'/../create/transactionsCreate.php';
        // }

        public function store(): void
        {
            $this->transaction->create($this->getFormData());
            header("Location: transactions.php");
            exit();
        }

        private function getFormData(): array
        {
            return [
                'customer_name' => $_POST['customer_code'],
                'supplier_name' => $_POST['company_name'],
                'game_title' => $_POST['game_title'],
                'quantity' => $_POST['quantity'],
                'unit_price' => $_POST['unit_price'],
                'discount_percent' => $_POST['discount_percent'],
                'tax_percent' => $_POST['tax_percent'],
                'transaction_type' => $_POST['transaction_type'],
                'payment_method' => $_POST['payment_method'],
                'order_status' => $_POST['order_status'],
                'shipping_address' => $_POST['shipping_address'],
                'billing_address' => $_POST['billing_address'],
                'reference_note' => $_POST['reference_note'],
                'notes' => $_POST['notes'],
                'created_at' => $_POST['created_at'],
                'updated_at' => $_POST['updated_at']
            ];
        }
    }
?>