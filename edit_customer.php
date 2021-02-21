<?php
require_once __DIR__.'/services/ServiceCustomer.php';

$id = $_GET['id'];
$service = new CustomerService;
$customer=$service->GetCustomerById($id);

if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $phone = $_POST['phone']; 
    $fax = $_POST['fax'];
           $email = $_POST['email'];
    if ($service->UpdateCustomer($fname, $lname, $company,$address,$city, $state, 
                                  $country, $postalcode,  $phone,$fax
                                  ,$email)) {
         header("Location: index.php");
     }
}

?>

<?php require 'header.php'; ?>
<div class="container">
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
                    <input value="<?= $customer->FirstName; ?>" type="text" name="fname" id="fname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input value="<?= $customer->LastName ?>" type="text" name="lname" id="lname" class="form-control">
                </div>                
                <div class="form-group">
                    <label for="company">Company</label>
                    <input value="<?= $customer->Company; ?>" type="text" name="company" id="company" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input value="<?= $customer->City; ?>" type="text" name="city" id="city" class="form-control">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input value="<?= $customer->State; ?>" type="text" name="state" id="state" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input value="<?= $customer->Country; ?>" type="text" name="country" id="country" class="form-control">
                </div>
                <div class="form-group">
                    <label for="postalcode">Postal Code</label>
                    <input value="<?= $customer->PostalCode; ?>" type="text" name="postalcode" id="postalcode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input value="<?= $customer->Phone; ?>" type="phone" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input value="<?= $customer->Fax; ?>" type="text" name="fax" id="fax" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input readonly value="<?= $customer->Email; ?>" type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update Customer</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
