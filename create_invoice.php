<?php
require_once __DIR__.'../services/ServiceInvoice.php';

$service = new InvoiceService;

if ($service->isDataValid()) 
{
    $customerId = $_POST['customerId'];
    $invoiceDate = $_POST['invoiceDate'];
    $billingAddress = $_POST['billingAddress'];
    $billingCity = $_POST['billingCity'];
    $billingState = $_POST['billingState'];
    $billingCountry = $_POST['billingCountry'];
    $billingPostalCode = $_POST['billingPostalCode'];
    $total = $_POST['total'];
    
    $service->InsertInvoice($customerId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $total);

} else {
    echo 'Not insertaed';
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create An Invoice</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="customerId">Customer ID</label>
                    <input type="text" name="customerId" id="customerId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="invoiceDate">Invoice Date</label>
                    <input type="date_format" name="invoiceDate" id="invoiceDate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billingAddress">Billing Address</label>
                    <input type="text" name="billingAddress" id="billingAddress" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billingCity">Billing City</label>
                    <input type="text" name="billingCity" id="billingCity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billingState">Billing State</label>
                    <input type="text" name="billingState" id="billingState" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billingCountry">Billing Country</label>
                    <input type="text" name="billingCountry" id="billingCountry" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billingPostalCode">Billing Postal Code</label>
                    <input type="text" name="billingPostalCode" id="billingPostalCode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" name="total" id="total" class="form-control">
                </div>                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Create An Invoice</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
