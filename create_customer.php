<?php
require_once __DIR__.'../services/ServiceCustomer.php';

$service = new CustomerService;

if ($service->isDataValid()) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $phone = $_POST['phone']; 
    $fax = $_POST['fax']; 
    $email = $_POST['email'];

    $service->InsertCustomer($fname, $lname, $password, $company, $address, 
    $city, $state, $country, $postalcode, $phone, $fax, $email);
        
} else {
    echo 'Not insertaed';
}
?>

<?php require 'header.php'; ?>
<div align="center" class="customercontainer">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create A Customer</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" name="company" id="company" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control">
                </div>
                <div class="form-group">
                    <label for="postalcode">Postal Code</label>
                    <input type="text" name="postalcode" id="postalcode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="phone" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="text" name="fax" id="fax" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Create A Customer</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
