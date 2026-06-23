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
            $Searchterm = '';

            // Keep the user's chosen sort (newest|oldest) for the view
            $sortParam = $_GET['sort'] ?? 'newest';
            $sortParam = ($sortParam === 'oldest') ? 'oldest' : 'newest';

            // Map to DB column and order
            $sortColumn = 'created_at';
            $order = ($sortParam === 'oldest') ? 'ASC' : 'DESC';

            $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
            $perPage = 10;

            if (isset($_GET['search']) && trim($_GET['search']) !== '') {
                $Searchterm = trim($_GET['search']);
                $totalCount = $this->transaction->countSearch($Searchterm);
                $totalPages = max(1, (int) ceil($totalCount / $perPage));
                $currentPage = min($page, $totalPages);
                $transactionresults = $this->transaction->search($Searchterm, $sortColumn, $order, $currentPage, $perPage);
            } else {
                $totalCount = $this->transaction->countAll();
                $totalPages = max(1, (int) ceil($totalCount / $perPage));
                $currentPage = min($page, $totalPages);
                $transactionresults = $this->transaction->all($sortColumn, $order, $currentPage, $perPage);
            }

            // expose variables expected by the view
            $totalPages = $totalPages ?? 1;
            $currentPage = $currentPage ?? 1;
            $sortParam = $sortParam;
            $currentSort = $sortParam;

            require dirname(__DIR__) . '/views/transactionsView.php';
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

        return [
            'transaction_type' => $_POST['transaction_type'] ?? null,
            'customer_name'    => !empty($_POST['customer_name']) ? trim($_POST['customer_name']) : null,
            'company'          => !empty($_POST['company']) ? trim($_POST['company']) : null,
            'game_id'          => !empty($_POST['game_id']) ? (int)$_POST['game_id'] : null,
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