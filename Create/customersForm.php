<?php
include __DIR__ . "/../Controller/customersController.php";
?>
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
            <input type="text" name="first_name" placeholder="Enter first name" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Last Name:</label>
            <input type="text" name="last_name" placeholder="Enter last name" required>
        </div>  
        <br>
        <div class="mb-3">
            <label class="form-label">Gender:</label>
            <br>
            <input type="radio" name="gender" value="Male" required>Male</input>
            <input type="radio" name="gender" value="Female" required>Female</input>
            <input type="radio" name="gender" value="Other" required>Other</input>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
            <input type="date" name="date_of_birth" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" placeholder="Enter email address" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="tel" name="phone" placeholder="Enter phone number" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Street:</label>
            <input type="text" name="street" placeholder="Enter street name" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">House Number:</label>
            <input type="text" name="house_number" placeholder="Enter house number" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Postal Code:</label>
            <input type="text" name="postal_code" placeholder="Enter postal code" required
            pattern="[0-9]{4}\s?[a-zA-Z]{2}" title="Please enter a valid postal code (e.g., 1234 AB)">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">City:</label>
            <input type="text" name="city" placeholder="Enter city" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Country:</label>
            <input type="text" name="country" placeholder="Enter country" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Registration Date:</label>
            <input type="date" name="registration_date" required>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Customer Status:</label>
            <input type="radio" name="customer_status" value="Active" required>Active</input>
            <input type="radio" name="customer_status" value="Inactive" required>Inactive</input>
            <input type="radio" name="customer_status" value="Blocked" required>Blocked</input>
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Loyalty Points:</label>
            <input type="number" name="loyalty_points" placeholder="Enter loyalty points" required min="0">
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label">Newsletter Subscribed:</label>
            <input type="radio" name="newsletter_subscribed" value="1">Yes</input>
            <input type="radio" name="newsletter_subscribed" value="0">No</input>
        </div>
    </form>
</body>