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