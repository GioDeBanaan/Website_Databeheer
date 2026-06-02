<?php
include __DIR__ . "/../Controller/customersController.php";
?>
<<<<<<< HEAD
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Add Customer </title>
    </head>
    <body>
        <div class="container mt-4 d-flex justify-content-center" >
=======
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Add Customer </title>
</head>
<body>
            <div class="container mt-4 d-flex justify-content-center" >
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
            <a href="../Pages/customers.php" class="btn btn-success mb-3">Return</a>
        </div>
        <div class="mb-3">
            <label class="form-label">First Name:</label>
<<<<<<< HEAD
            <div class="input-group">
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" value="<?= htmlspecialchars($customer['first_name'] ?? '') ?>" required>
            </div>
=======
            <input type="text" name="first_name" placeholder="Enter first name" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Last Name:</label>
<<<<<<< HEAD
            <div class="input-group">
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" value="<?= htmlspecialchars($customer['last_name'] ?? '') ?>" required>
            </div>
=======
            <input type="text" name="last_name" placeholder="Enter last name" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>  
        <br>
        <div class="mb-3">
            <label class="form-label">Gender:</label>
            <br>
<<<<<<< HEAD
            <input type="radio" id="gender_male" name="gender" value="Male" <?= isset($customer['gender']) && $customer['gender'] === 'Male' ? 'checked' : '' ?> required>
            <label for="gender_male">Male</label>
            <input type="radio" id="gender_female" name="gender" value="Female" <?= isset($customer['gender']) && $customer['gender'] === 'Female' ? 'checked' : '' ?> required>
            <label for="gender_female">Female</label>
            <input type="radio" id="gender_other" name="gender" value="Other" <?= isset($customer['gender']) && $customer['gender'] === 'Other' ? 'checked' : '' ?> required>
            <label for="gender_other">Other</label>
=======
            <input type="radio" name="gender" value="Male" required>Male</input>
            <input type="radio" name="gender" value="Female" required>Female</input>
            <input type="radio" name="gender" value="Other" required>Other</input>
            <input type="radio" name="gender" value="Prefer_not_to_say" required>Prefer not to say</input>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
<<<<<<< HEAD
            <input type="date" name="date_of_birth" value="<?= htmlspecialchars($customer['date_of_birth'] ?? '') ?>" required>
=======
            <input type="date" name="date_of_birth" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Email:</label>
<<<<<<< HEAD
            <input type="email" name="email" placeholder="Enter email address" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" required>
=======
            <input type="email" name="email" placeholder="Enter email address" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Phone:</label>
<<<<<<< HEAD
            <input type="tel" name="phone" placeholder="Enter phone number" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" required>
=======
            <input type="tel" name="phone" placeholder="Enter phone number" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Street:</label>
<<<<<<< HEAD
            <input type="text" name="street" placeholder="Enter street name" value="<?= htmlspecialchars($customer['street'] ?? '') ?>" required>
=======
            <input type="text" name="street" placeholder="Enter street name" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">House Number:</label>
<<<<<<< HEAD
            <input type="text" name="house_number" placeholder="Enter house number" value="<?= htmlspecialchars($customer['house_number'] ?? '') ?>" required>
=======
            <input type="text" name="house_number" placeholder="Enter house number" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Postal Code:</label>
<<<<<<< HEAD
            <input type="text" name="postal_code" placeholder="Enter postal code" value="<?= htmlspecialchars($customer['postal_code'] ?? '') ?>" required
=======
            <input type="text" name="postal_code" placeholder="Enter postal code" required
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
            pattern="[0-9]{4}\s?[a-zA-Z]{2}" title="Please enter a valid postal code (e.g., 1234 AB)">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">City:</label>
<<<<<<< HEAD
            <input type="text" name="city" placeholder="Enter city" value="<?= htmlspecialchars($customer['city'] ?? '') ?>" required>
=======
            <input type="text" name="city" placeholder="Enter city" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Country:</label>
<<<<<<< HEAD
            <input type="text" name="country" placeholder="Enter country" value="<?= htmlspecialchars($customer['country'] ?? '') ?>" required>
=======
            <input type="text" name="country" placeholder="Enter country" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Registration Date:</label>
<<<<<<< HEAD
            <input type="date" name="registration_date" value="<?= htmlspecialchars($customer['registration_date'] ?? '') ?>" required>
=======
            <input type="date" name="registration_date" required>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Customer Status:</label>
<<<<<<< HEAD
            <input type="radio" name="customer_status" value="Active" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Active' ? 'checked' : '' ?> required>Active</input>
            <input type="radio" name="customer_status" value="Inactive" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Inactive' ? 'checked' : '' ?> required>Inactive</input>
            <input type="radio" name="customer_status" value="Blocked" <?= isset($customer['customer_status']) && $customer['customer_status'] === 'Blocked' ? 'checked' : '' ?> required>Blocked</input>
=======
            <input type="radio" name="customer_status" value="Active" required>Active</input>
            <input type="radio" name="customer_status" value="Inactive" required>Inactive</input>
            <input type="radio" name="customer_status" value="Blocked" required>Blocked</input>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Loyalty Points:</label>
            <input type="number" name="loyalty_points" placeholder="Enter loyalty points" required min="0">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Newsletter Subscribed:</label>
<<<<<<< HEAD
            <input type="radio" name="newsletter_subscribed" value="1" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '1' ? 'checked' : '' ?>>Yes</input>
            <input type="radio" name="newsletter_subscribed" value="0" <?= isset($customer['newsletter_subscribed']) && $customer['newsletter_subscribed'] === '0' ? 'checked' : '' ?>>No</input>
        </div>
                <button type="submit" class="btn btn-primary">Add customer</button>
    </form>
</body>
</html>
=======
            <input type="radio" name="newsletter_subscribed" value="1">Yes</input>
            <input type="radio" name="newsletter_subscribed" value="0">No</input>
        </div>
    </form>
</body>
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
