<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Edit Supplier</title>
    </head>
    <body>
        <form method="POST" action="../Pages/Suppliers.php?action=update&id=<?= $supplier['supplier_id'] ?>">
            <div class="container mt-4 d-flex justify-content-center">
                <a href="../Pages/suppliers.php" class="btn btn-success mb-3">Return</a>
            </div>

            <div class="mb-3">
                <label class="form-label">Supplier Code:</label>
                <input type="text" name="supplier_code" class="form-control" value="<?= htmlspecialchars($supplier['supplier_code'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Company Name:</label>
                <input type="text" name="company_name" class="form-control" value="<?= htmlspecialchars($supplier['company_name'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Person:</label>
                <input type="text" name="contact_person" class="form-control" value="<?= htmlspecialchars($supplier['contact_person'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($supplier['email'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone:</label>
                <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($supplier['phone'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Website:</label>
                <input type="url" name="website" class="form-control" value="<?= htmlspecialchars($supplier['website'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Chamber of Commerce Number (KVK):</label>
                <input type="text" name="chamber_of_commerce_number" class="form-control" value="<?= htmlspecialchars($supplier['chamber_of_commerce_number'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VAT Number (BTW):</label>
                <input type="text" name="vat_number" class="form-control" value="<?= htmlspecialchars($supplier['vat_number'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Street:</label>
                <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($supplier['street'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">House Number:</label>
                <input type="text" name="house_number" class="form-control" value="<?= htmlspecialchars($supplier['house_number'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Postal Code:</label>
                <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars($supplier['postal_code'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">City:</label>
                <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($supplier['city'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Country:</label>
                <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($supplier['country'] ?? 'Netherlands') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Bank Account (IBAN):</label>
                <input type="text" name="bank_account" class="form-control" value="<?= htmlspecialchars($supplier['bank_account'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Delivery Time (days):</label>
                <input type="number" name="delivery_time_days" class="form-control" min="0" value="<?= htmlspecialchars($supplier['delivery_time_days'] ?? 7) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Supplier Rating:</label>
                <input type="number" name="supplier_rating" class="form-control" min="0" max="5" step="0.01" value="<?= htmlspecialchars($supplier['supplier_rating'] ?? '5.00') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label><br>
                <input type="radio" name="is_active" value="1" <?= !isset($supplier['is_active']) || $supplier['is_active'] == 1 ? 'checked' : '' ?>>
                <label>Active</label>
                <input type="radio" name="is_active" value="0" <?= isset($supplier['is_active']) && $supplier['is_active'] == 0 ? 'checked' : '' ?>>
                <label>Inactive</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Notes:</label>
                <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($supplier['notes'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Supplier</button>
        </form>
    </body>
</html>