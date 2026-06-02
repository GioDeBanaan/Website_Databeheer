<?php
include __DIR__ . "/../Controller/customersController.php";
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title><?= isset($customer) ? "Edit Customer" : "Add Customer" ?></title>
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Pages/customers.php" class="btn btn-success mb-3">Return</a>
        </div>
        <div class="row gy-3">
        <div class="col-md-6">
            <label class="form-label">First Name:</label>
            <input type="text" name="first_name" placeholder="Enter first name" required value="<?= htmlspecialchars($customer['first_name'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Last Name:</label>
            <input type="text" name="last_name" placeholder="Enter last name" required value="<?= htmlspecialchars($customer['last_name'] ?? '') ?>">
        </div>  
        <br>
        <div class="col-md-6">
            <label class="form-label">Gender:</label>
            <input type="radio" name="gender" value="Male" required <?= isset($customer['gender']) && $customer['gender'] === 'Male' ? 'checked' : '' ?>>Male</input>
            <input type="radio" name="gender" value="Female" required <?= isset($customer['gender']) && $customer['gender'] === 'Female' ? 'checked' : '' ?>>Female</input>
            <input type="radio" name="gender" value="Other" required <?= isset($customer['gender']) && $customer['gender'] === 'Other' ? 'checked' : '' ?>>Other</input>
            <input type="radio" name="gender" value="Prefer_not_to_say" required <?= isset($customer['gender']) && $customer['gender'] === 'Prefer_not_to_say' ? 'checked' : '' ?>>Prefer not to say</input>
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Date of Birth:</label>
            <input type="date" name="date_of_birth" required value="<?= htmlspecialchars($customer['date_of_birth'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Email:</label>
            <input type="email" name="email" placeholder="Enter email address" required value="<?= htmlspecialchars($customer['email'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Phone:</label>
            <input type="tel" name="phone" placeholder="Enter phone number" required value="<?= htmlspecialchars($customer['phone'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Street:</label>
            <input type="text" name="street" placeholder="Enter street name" required value="<?= htmlspecialchars($customer['street'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">House Number:</label>
            <input type="text" name="house_number" placeholder="Enter house number" required value="<?= htmlspecialchars($customer['house_number'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Postal Code:</label>
            <input type="text" name="postal_code" placeholder="Enter postal code" required value="<?= htmlspecialchars($customer['postal_code'] ?? '') ?>" pattern="[0-9]{4}\s?[a-zA-Z]{2}" title="Please enter a valid postal code (e.g., 1234 AB)">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">City:</label>
            <input type="text" name="city" placeholder="Enter city" required value="<?= htmlspecialchars($customer['city'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Country:</label>
            <input type="text" name="country" placeholder="Enter country" required value="<?= htmlspecialchars($customer['country'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Registration Date:</label>
            <input type="date" name="registration_date" required value="<?= htmlspecialchars($customer['registration_date'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Customer Status:</label>
            <input type="radio" name="customer_status" value="Active" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Active' ? 'checked' : '' ?>>Active</input>
            <input type="radio" name="customer_status" value="Inactive" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Inactive' ? 'checked' : '' ?>>Inactive</input>
            <input type="radio" name="customer_status" value="Blocked" required <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Blocked' ? 'checked' : '' ?>>Blocked</input>
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Loyalty Points:</label>
            <input type="number" name="loyalty_points" placeholder="Enter loyalty points" required min="0" value="<?= htmlspecialchars($customer['loyalty_points'] ?? '') ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label class="form-label">Newsletter Subscribed:</label>
            <input type="radio" name="newsletter_subscribed" value="1" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '1' ? 'checked' : '' ?>>Yes</input>
            <input type="radio" name="newsletter_subscribed" value="0" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '0' ? 'checked' : '' ?>>No</input>
        </div>
</div>
