<?php
require_once __DIR__ . "/../Models/suppliersget.php";

if (!class_exists('SuppliersController')) {
    class SuppliersController
    {
        private Suppliers $Suppliers;

        public function __construct()
        {
            $this->Suppliers = new Suppliers();
        }

        public function index(string $sort = 'supplier_id', string $order = 'DESC'): void
        {
            $Suppliersresult = $this->Suppliers->all($sort, $order);
            require __DIR__ . '/../views/suppliersView.php';
        }

        public function create(): void
        {
            require __DIR__ . '/../Create/suppliersCreate.php';
        }

        public function store(): void
        {
            $this->Suppliers->create($this->getFormData());
            header("Location: suppliers.php");
            exit();
        }

        public function edit(int $id): void
        {
            $supplier = $this->Suppliers->find($id);
            if (!$supplier) {
                die("Supplier not found");
            }
            require __DIR__ . '/../Create/suppliersEdit.php';
        }

        public function update(int $id): void
        {
            $this->Suppliers->update($id, $this->getFormData());
            header("Location: suppliers.php");
            exit();
        }

        public function delete(int $id): void
        {
            $this->Suppliers->delete($id);
            header("Location: suppliers.php");
            exit();
        }

        private function getFormData(): array
        {
            return [
                'supplier_code'              => $_POST['supplier_code'] ?? '',
                'company_name'               => $_POST['company_name'] ?? '',
                'contact_person'             => $_POST['contact_person'] ?? '',
                'email'                      => $_POST['email'] ?? '',
                'phone'                      => $_POST['phone'] ?? '',
                'website'                    => $_POST['website'] ?? '',
                'chamber_of_commerce_number' => $_POST['chamber_of_commerce_number'] ?? '',
                'vat_number'                 => $_POST['vat_number'] ?? '',
                'street'                     => $_POST['street'] ?? '',
                'house_number'               => $_POST['house_number'] ?? '',
                'postal_code'                => $_POST['postal_code'] ?? '',
                'city'                       => $_POST['city'] ?? '',
                'country'                    => $_POST['country'] ?? 'Netherlands',
                'bank_account'               => $_POST['bank_account'] ?? '',
                'delivery_time_days'         => $_POST['delivery_time_days'] ?? 7,
                'supplier_rating'            => $_POST['supplier_rating'] ?? 5.00,
                'is_active'                  => $_POST['is_active'] ?? 1,
                'notes'                      => $_POST['notes'] ?? '',
            ];
        }
    }
}
?>