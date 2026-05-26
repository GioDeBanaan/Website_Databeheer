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
            $customerresult = $this->customer->all();

        require __DIR__ . '/../views/customersView.php';
        }

        // public function create(): void
        // {
        //     require __DIR__ .'/../create/customersCreate.php';
        // }

        public function store(): void
        {
            $this->customer->create($this->getFormData());
            header("Location: customers.php");
            exit();
        }

        private function getFormData(): array
        {
            return [
                'customer_code' => $_POST['customer_code'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'gender' => $_POST['gender'],
                'date_of_birth' => $_POST['date_of_birth'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'street' => $_POST['street'],
                'house_number' => $_POST['house_number'],
                'postal_code' => $_POST['postal_code'],
                'city' => $_POST['city'],
                'country' => $_POST['country']
            ];
        }
    }
?>