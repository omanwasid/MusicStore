<?php
require_once __DIR__.'../services/ServiceInvoiceLine.php';

$service = new InvoiceLineService;

if ($service->isDataValid()) 
{
    $invoiceId = $_POST['invoiceId'];
    $trackId = $_POST['trackId'];
    $unitPrice = $_POST['unitPrice'];
    $quantity = $_POST['quantity'];
    
    $service->InsertInvoiveLine($invoiceId, $trackId, $unitPrice, $quantity);
    
} else {
    echo 'Not insertaed';
}
?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create An Invoiveline</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="invoiceId">Invoice ID</label>
                    <input type="text" name="invoiceId" id="invoiceId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="trackId">Track ID</label>
                    <input type="text" name="trackId" id="trackId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unitPrice">Unit Price</label>
                    <input type="text" name="unitPrice" id="unitPrice" class="form-control">
                </div>     
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" id="quantity" class="form-control">
                </div>                           
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Create An Invoiveline</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
