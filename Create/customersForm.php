<?php
include __DIR__ . "/../Controller/customersController.php";
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Add Customer </title>
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
            <a href="../Pages/customers.php" class="btn btn-success mb-3">Return</a>
        </div>
        <div class="mb-3">
            <label class="form-label">First Name:</label>
            <div class="input-group">
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" value="<?= htmlspecialchars($customer['first_name'] ?? '') ?>" required>
            </div>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Last Name:</label>
            <div class="input-group">
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" value="<?= htmlspecialchars($customer['last_name'] ?? '') ?>" required>
            </div>
        </div>  
        <br>
        <div class="mb-3">
            <label class="form-label">Gender:</label>
            <br>
            <input type="radio" id="gender_male" name="gender" value="Male" <?= isset($customer['gender']) && $customer['gender'] === 'Male' ? 'checked' : '' ?> required>
            <label for="gender_male">Male</label>
            <input type="radio" id="gender_female" name="gender" value="Female" <?= isset($customer['gender']) && $customer['gender'] === 'Female' ? 'checked' : '' ?> required>
            <label for="gender_female">Female</label>
            <input type="radio" id="gender_other" name="gender" value="Other" <?= isset($customer['gender']) && $customer['gender'] === 'Other' ? 'checked' : '' ?> required>
            <label for="gender_other">Other</label>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
            <input type="date" name="date_of_birth" value="<?= htmlspecialchars($customer['date_of_birth'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" placeholder="Enter email address" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="tel" name="phone" placeholder="Enter phone number" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Street:</label>
            <input type="text" name="street" placeholder="Enter street name" value="<?= htmlspecialchars($customer['street'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">House Number:</label>
            <input type="text" name="house_number" placeholder="Enter house number" value="<?= htmlspecialchars($customer['house_number'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Postal Code:</label>
            <input type="text" name="postal_code" placeholder="Enter postal code" value="<?= htmlspecialchars($customer['postal_code'] ?? '') ?>" required
            pattern="[0-9]{4}\s?[a-zA-Z]{2}" title="Please enter a valid postal code (e.g., 1234 AB)">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">City:</label>
            <input type="text" name="city" placeholder="Enter city" value="<?= htmlspecialchars($customer['city'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Country:</label>
            <input type="text" name="country" placeholder="Enter country" value="<?= htmlspecialchars($customer['country'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Registration Date:</label>
            <input type="date" name="registration_date" value="<?= htmlspecialchars($customer['registration_date'] ?? '') ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Customer Status:</label>
            <input type="radio" name="customer_status" value="Active" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Active' ? 'checked' : '' ?> required>Active</input>
            <input type="radio" name="customer_status" value="Inactive" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Inactive' ? 'checked' : '' ?> required>Inactive</input>
            <input type="radio" name="customer_status" value="Blocked" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Blocked' ? 'checked' : '' ?> required>Blocked</input>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Loyalty Points:</label>
            <input type="number" name="loyalty_points" placeholder="Enter loyalty points" required min="0">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Newsletter Subscribed:</label>
            <input type="radio" name="newsletter_subscribed" value="1" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '1' ? 'checked' : '' ?>>Yes</input>
            <input type="radio" name="newsletter_subscribed" value="0" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '0' ? 'checked' : '' ?>>No</input>
        </div>
                <button type="submit" class="btn btn-primary">Add customer</button>
    </form>
</body>
</html>