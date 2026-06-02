<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Edit Supplier</title>
        <style>
            body {
                background-color: #f8f9fa;
            }
            .form-card {
                background: white;
                border-radius: 8px;
                padding: 2rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .section-title {
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #6c757d;
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 0.5rem;
                margin-bottom: 1rem;
                margin-top: 1.5rem;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5" style="max-width: 800px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Edit Supplier</h4>
                <a href="../Pages/suppliers.php" class="btn btn-outline-secondary">← Return</a>
            </div>

            <div class="form-card">
                <form method="POST" action="../Pages/suppliers.php?action=update&id=<?= $supplier['supplier_id'] ?>">

                    <p class="section-title">General</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Supplier Code <span class="text-danger">*</span></label>
                            <input type="text" name="supplier_code" class="form-control" value="<?= htmlspecialchars($supplier['supplier_code'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" value="<?= htmlspecialchars($supplier['company_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" value="<?= htmlspecialchars($supplier['contact_person'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website</label>
                            <input type="url" name="website" class="form-control" value="<?= htmlspecialchars($supplier['website'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">Contact</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($supplier['email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($supplier['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">Address</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($supplier['street'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">House Number</label>
                            <input type="text" name="house_number" class="form-control" value="<?= htmlspecialchars($supplier['house_number'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars($supplier['postal_code'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($supplier['city'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($supplier['country'] ?? 'Netherlands') ?>">
                        </div>
                    </div>

                    <p class="section-title">Financial</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Chamber of Commerce (KVK)</label>
                            <input type="text" name="chamber_of_commerce_number" class="form-control" value="<?= htmlspecialchars($supplier['chamber_of_commerce_number'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">VAT Number (BTW)</label>
                            <input type="text" name="vat_number" class="form-control" value="<?= htmlspecialchars($supplier['vat_number'] ?? '') ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Bank Account (IBAN)</label>
                            <input type="text" name="bank_account" class="form-control" value="<?= htmlspecialchars($supplier['bank_account'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">Other</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Delivery Time (days)</label>
                            <input type="number" name="delivery_time_days" class="form-control" min="0" value="<?= htmlspecialchars($supplier['delivery_time_days'] ?? 7) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Supplier Rating</label>
                            <input type="number" name="supplier_rating" class="form-control" min="0" max="5" step="0.01" value="<?= htmlspecialchars($supplier['supplier_rating'] ?? '5.00') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label><br>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="radio" name="is_active" value="1" <?= !isset($supplier['is_active']) || $supplier['is_active'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" value="0" <?= isset($supplier['is_active']) && $supplier['is_active'] == 0 ? 'checked' : '' ?>>
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($supplier['notes'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Supplier</button>
                        <a href="../Pages/suppliers.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>