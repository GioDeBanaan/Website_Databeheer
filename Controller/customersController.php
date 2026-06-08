<?php
    require_once __DIR__ . "/../Models/customersget.php";
    class CustomersController
    {
        private Customer $customer;

        public function __construct()
        {
            $this->customer = new Customer();
        }
        public function index(): void
        {
            $Searchterm = '';
            if (isset($_GET['search'])) {
                $Searchterm = $_GET['search'];
                $customerresult = $this->customer->search($Searchterm);
            } else {
                $customerresult = $this->customer->all();
            }
        require __DIR__ . '/../views/customersView.php';
        }

        public function create(): void
        {
            require __DIR__ .'/../create/customersCreate.php';
        }

        public function store(): void
        {
            $this->customer->create($this->getFormData());
            header("Location: customers.php");
            exit();
        }

        public function edit(int $id): void
        {
            $customer = $this->customer->find($id);
            if (!$customer) {
                die("Customer not found");
            }

            require __DIR__ . '/../Create/customersEdit.php';
        }

        public function update(int $id): void
        {
            $this->customer->update($id, $this->getFormData());
            header("Location: customers.php");
            exit();
        }

        private function getFormData(): array
        {
            return [
                'first_name' => $_POST['first_name'] ?? null,
                'last_name' => $_POST['last_name'] ?? null,
                'gender' => $_POST['gender'] ?? null,
                'date_of_birth' => $_POST['date_of_birth'] ?? null,
                'email' => $_POST['email'] ?? null,
                'phone' => $_POST['phone'] ?? null,
                'street' => $_POST['street'] ?? null,
                'house_number' => $_POST['house_number'] ?? null,
                'postal_code' => $_POST['postal_code'] ?? null,
                'city' => $_POST['city'] ?? null,
                'country' => $_POST['country'] ?? null,
                'registration_date' => $_POST['registration_date'] ?? null,
                'customer_status' => $_POST['customer_status'] ?? null,
                'loyalty_points' => $_POST['loyalty_points'] ?? 0,
                'newsletter_subscribed' => $_POST['newsletter_subscribed'] ?? 0,
            ];
        }
    }
?>