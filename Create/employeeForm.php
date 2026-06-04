<?php
$submitLabel = $submitLabel ?? 'Save';
$cancelUrl = $cancelUrl ?? '../Pages/employee.php';
?>
<form method="post" action="">
    <div class="row gy-3">
        <div class="col-12">
            <h4 class="mb-3">Personal and Contact Information</h4>
        </div>
        <div class="col-md-3">
            <label class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee['first_name'] ?? '') ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee['last_name'] ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Birth date</label>
            <input type="date" name="birth_date" class="form-control" value="<?= htmlspecialchars($employee['birth_date'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee['email'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($employee['phone'] ?? '') ?>">
        </div>

        <div class="col-12 mt-4">
            <h4 class="mb-3">Work Data</h4>
        </div>
        <div class="col-md-3">
            <label class="form-label">Job title</label>
            <input type="text" name="job_title" class="form-control" value="<?= htmlspecialchars($employee['job_title'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Department</label>
            <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($employee['department'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Contract type</label>
           <input type="radio" name="contract_type" value="Fulltime" <?= (isset($employee['contract_type']) && $employee['contract_type'] === 'Fulltime') ? 'checked' : '' ?>> Fulltime
           <input type="radio" name="contract_type" value="Parttime" <?= (isset($employee['contract_type']) && $employee['contract_type'] === 'Parttime') ? 'checked' : '' ?>> Parttime
           <input type="radio" name="contract_type" value="Intern" <?= (isset($employee['contract_type']) && $employee['contract_type'] === 'Intern') ? 'checked' : '' ?>> Intern
           <input type="radio" name="contract_type" value="Temporary" <?= (isset($employee['contract_type']) && $employee['contract_type'] === 'Temporary') ? 'checked' : '' ?>> Temporary
        </div>
        <div class="col-md-3">
            <label class="form-label">Employment status</label>
            <input type="text" name="employment_status" class="form-control" value="<?= htmlspecialchars($employee['employment_status'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Hire date</label>
            <input type="date" name="hire_date" class="form-control" value="<?= htmlspecialchars($employee['hire_date'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" value="<?= htmlspecialchars($employee['salary'] ?? '') ?>">
        </div>

        <div class="col-12 mt-4">
            <h4 class="mb-3">Address</h4>
        </div>
        <div class="col-md-6">
            <label class="form-label">Street</label>
            <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($employee['street'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <label class="form-label">House number</label>
            <input type="text" name="house_number" class="form-control" value="<?= htmlspecialchars($employee['house_number'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Postal code</label>
            <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars($employee['postal_code'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($employee['city'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($employee['country'] ?? '') ?>">
        </div>

        <div class="col-12 mt-4">
            <h4 class="mb-3">Emergency Contact</h4>
        </div>
        <div class="col-md-6">
            <label class="form-label">Emergency contact name</label>
            <input type="text" name="emergency_contact_name" class="form-control" value="<?= htmlspecialchars($employee['emergency_contact_name'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Emergency contact phone</label>
            <input type="text" name="emergency_contact_phone" class="form-control" value="<?= htmlspecialchars($employee['emergency_contact_phone'] ?? '') ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($employee['notes'] ?? '') ?></textarea>
        </div>
    </div>
    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submitLabel) ?></button>
        <a href="<?= htmlspecialchars($cancelUrl) ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
