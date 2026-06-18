<?php

require_once __DIR__ . '/../Models/transactionsget.php';

class TransactionsController
{
    private Transaction $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function index(string $sort = 'transaction_id', string $order = 'DESC'): void
    {
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $perPage = 10;

        if (isset($_GET['search']) && trim($_GET['search']) !== '') {
            $searchterm = trim($_GET['search']);
            $totalCount = $this->transaction->countSearch($searchterm);
            $totalPages = max(1, (int) ceil($totalCount / $perPage));
            $currentPage = min($page, $totalPages);
            $transactionresults = $this->transaction->search($searchterm, $sort, $order, $currentPage, $perPage);
        } else {
            $totalCount = $this->transaction->countAll();
            $totalPages = max(1, (int) ceil($totalCount / $perPage));
            $currentPage = min($page, $totalPages);
            $transactionresults = $this->transaction->all($sort, $order, $currentPage, $perPage);
        }

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
        if (!isset($_POST['transaction_type'])) {
            echo "<pre>CRITICAL: PHP cannot find 'transaction_type' in the submitted form.\n";
            echo "Here is what PHP actually received:\n";
            print_r($_POST);
            echo "</pre>";
            die();
        }

        // Tip: (int) is hier weggehaald bij customer_name, company en game_name 
        // omdat dit tekstvelden (varchar) zijn in je database!
        return [
            'transaction_type' => $_POST['transaction_type'] ?? null,
            'customer_name'    => !empty($_POST['customer_name']) ? trim($_POST['customer_name']) : null,
            'company'          => !empty($_POST['company']) ? trim($_POST['company']) : null,
            'game_name'        => !empty($_POST['game_name']) ? trim($_POST['game_name']) : null,
            'transaction_date' => $_POST['transaction_date'] ?? null,
            'quantity'         => !empty($_POST['quantity']) ? (int)$_POST['quantity'] : 0,
            'unit_price'       => $_POST['unit_price'] ?? '0.00',
            'discount_percent' => $_POST['discount_percent'] ?? '0.00',
            'tax_percent'      => $_POST['tax_percent'] ?? '0.00',
            'payment_method'   => $_POST['payment_method'] ?? null,
            'payment_status'   => isset($_POST['payment_status']) ? trim($_POST['payment_status']) : null,
            'order_status'     => isset($_POST['order_status']) ? trim($_POST['order_status']) : null,
        ];
    }
}