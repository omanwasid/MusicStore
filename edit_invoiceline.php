<?php
require_once __DIR__.'/ServiceInvoiceLine.php';

$id = $_GET['id'];

$service = new InvoiceLineService;
$invoiveline = $service->GetInvoiceLineById($id);

if (isset($_POST['invoiceId']) && isset($_POST['trackId']))  {
    $invoiceId = $_POST['invoiceId'];
    $trackId = $_POST['trackId'];
    $unitPrice = $_POST['unitPrice'];
    $quantity = $_POST['quantity'];            

    if ($service->UpdateInvoiceLine($invoiceId, $trackId, $unitPrice, $quantity, $id)) {
            header("Location: indexForInvoiceline.php");
        }
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Edit An Invoice Line</h2>
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
                    <input value="<?= $invoiceline->InvoiceId; ?>" type="text" name="invoiceId" id="invoiceId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="trackId">Track ID</label>
                    <input value="<?= $invoiceline->TrackId ?>" type="text" name="trackId" id="trackId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unitPrice">Unit Price</label>
                    <input value="<?= $invoiceline->UnitPrice; ?>" type="text" name="unitPrice" id="unitPrice" class="form-control">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input value="<?= $invoiceline->Quantity ?>" type="text" name="quantity" id="quantity" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update InvoiceLine</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
