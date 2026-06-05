                    <div class="form-card">
                <form method="POST" action="../Pages/suppliers.php?action=store">

                    <p class="section-title">General</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">transaction code <span class="text-danger">*</span></label>
                            <input type="text" name="transaction_code" class="form-control" placeholder="e.g. TRX-001" value="<?= htmlspecialchars($transaction['transaction_code'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Transaction type</label>
                            <input type="text" name="transaction_type" class="form-control" placeholder="Enter transaction type" value="<?= htmlspecialchars($transaction['transaction_type'] ?? '') ?>">
                        </div>
                        
                    </div>

                    <p class="section-title">ID's</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer ID</label>
                            <input type="text" name="customer_id" class="form-control" placeholder="Enter customer ID" value="<?= htmlspecialchars($transaction['customer_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Supplier ID <span class="text-danger">*</span></label>
                            <input type="text" name="supplier_id" class="form-control" placeholder="Enter supplier ID" value="<?= htmlspecialchars($transaction['supplier_id'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee ID</label>
                            <input type="text" name="employee_id" class="form-control" placeholder="Enter employee ID" value="<?= htmlspecialchars($transaction['employee_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Game ID</label>
                            <input type="text" name="game_id" class="form-control" placeholder="Enter game ID" value="<?= htmlspecialchars($transaction['game_id'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">general</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">transaction date</label>
                            <input type="date" name="transaction_date" class="form-control" value="<?= htmlspecialchars($transaction['transaction_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control" placeholder="e.g. 1" value="<?= htmlspecialchars($transaction['quantity'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit price</label>
                            <input type="text" name="unit_price" class="form-control" placeholder="Enter price" value="<?= htmlspecialchars($transaction['unit_price'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">discount percentage</label>
                            <input type="text" name="discount_percentage" class="form-control" placeholder="Enter discount percentage" value="<?= htmlspecialchars($transaction['discount_percentage'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">tax percentage</label>
                            <input type="text" name="tax_percentage" class="form-control" placeholder="Enter tax percentage" value="<?= htmlspecialchars($transaction['tax_percentage'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">no</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">payment Method</label>
                            <input type="text" name="payment_method" class="form-control" placeholder="Enter payment method" value="<?= htmlspecialchars($transaction['payment_method'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">payment status</label>
                            <input type="text" name="payment_status" class="form-control" placeholder="Enter payment status" value="<?= htmlspecialchars($transaction['payment_status'] ?? '') ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">order status</label>
                            <input type="text" name="order_status" class="form-control" placeholder="Enter order status" value="<?= htmlspecialchars($transaction['order_status'] ?? '') ?>">
                        </div>
                    </div>

                    <p class="section-title">Other</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">created at</label>
                            <input type="number" name="delivery_time_days" class="form-control" min="0" value="<?= htmlspecialchars($transaction['delivery_time_days'] ?? 7) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">updated at</label>
                            <input type="number" name="supplier_rating" class="form-control" min="0" max="5" step="0.01" value="<?= htmlspecialchars($transaction['supplier_rating'] ?? '5.00') ?>">
                        </div>
                                            <button type="submit" class="btn btn-primary px-4">Add Transaction</button>
                        <a href="../Pages/transactions.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>