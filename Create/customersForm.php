<?php
include __DIR__ . "/../Controller/customersController.php";
?>
<?php $submitLabel = $submitLabel ?? 'Save'; $cancelUrl = $cancelUrl ?? '../Pages/customers.php'; ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title><?= isset($customer) ? "Edit Customer" : "Add Customer" ?></title>
    </head>
    <body>
        <div class="container mt-4">
            <div class="d-flex justify-content-between mb-3">
                <a href="../Pages/customers.php" class="btn btn-success">Return</a>
            </div>
            <form method="post" action="">
                <div class="row gy-3">
                    <div class="col-12">
                        <h4 class="mb-3">Personal and Contact Information</h4>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required value="<?= htmlspecialchars($customer['first_name'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required value="<?= htmlspecialchars($customer['last_name'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <div class="d-flex flex-column">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required <?= isset($customer['gender']) && $customer['gender'] === 'Male' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" required <?= isset($customer['gender']) && $customer['gender'] === 'Female' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderOther" value="Other" required <?= isset($customer['gender']) && $customer['gender'] === 'Other' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderOther">Other</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderPrefer" value="Prefer not to say" required <?= isset($customer['gender']) && $customer['gender'] === 'Prefer not to say' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderPrefer">Prefer not to say</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required value="<?= htmlspecialchars($customer['date_of_birth'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email address" required value="<?= htmlspecialchars($customer['email'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" required value="<?= htmlspecialchars($customer['phone'] ?? '') ?>">
                    </div>
                            <div class="col-12 mt-4">
            <h4 class="mb-3">Address</h4>
        </div>
                    <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input type="text" name="street" class="form-control" placeholder="Enter street name" required value="<?= htmlspecialchars($customer['street'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">House Number</label>
                        <input type="text" name="house_number" class="form-control" placeholder="Enter house number" required value="<?= htmlspecialchars($customer['house_number'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" placeholder="Enter postal code" required value="<?= htmlspecialchars($customer['postal_code'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="Enter city" required value="<?= htmlspecialchars($customer['city'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" placeholder="Enter country" required value="<?= htmlspecialchars($customer['country'] ?? '') ?>">
                    </div>
                            <div class="col-12 mt-4">
            <h4 class="mb-3">Extra's</h4>
        </div>
                    <div class="col-md-6">
                        <label class="form-label">Registration Date</label>
                        <input type="date" name="registration_date" class="form-control" required value="<?= htmlspecialchars($customer['registration_date'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Customer Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_status" id="statusActive" value="Active" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Active' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusActive">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_status" id="statusInactive" value="Inactive" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Inactive' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusInactive">Inactive</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_status" id="statusBlocked" value="Blocked" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Blocked' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusBlocked">Blocked</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Loyalty Points</label>
                        <input type="number" name="loyalty_points" class="form-control" placeholder="Enter loyalty points" required min="0" value="<?= htmlspecialchars($customer['loyalty_points'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Newsletter Subscribed</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="newsletter_subscribed" id="newsletterYes" value="1" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '1' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="newsletterYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="newsletter_subscribed" id="newsletterNo" value="0" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '0' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="newsletterNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submitLabel) ?></button>
                    <a href="<?= htmlspecialchars($cancelUrl) ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </body>
</html>
