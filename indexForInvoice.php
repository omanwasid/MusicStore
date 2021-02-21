<?php
require_once __DIR__.'../services/ServiceInvoice.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new InvoiceService;
$total_pages = $service->GetTotalInvoicesCount($limit);

$invoice = $service->GetInvoices($page);

?>

<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Invoices</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="tablehead">
                        <th>Invoice ID</th>
                        <th>Customer ID</th>
                        <th>Invoice Date</th>                   
                        <th>Billing Address</th>
                        <th>Billing City</th>
                        <th>Billing State</th>
                        <th>Billing Country</th>
                        <th>Billing Postal Code</th>
                        <th>Total</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($invoice as $inv) {?>
                        
                        <tr>
                            <td><?= $inv->InvoiceId; ?></td>
                            <td><?= $inv->CustomerId; ?></td>
                            <td><?= $inv->InvoiceDate; ?></td>   
                            <td><?= $inv->BillingAddress; ?></td>
                            <td><?= $inv->BillingCity; ?></td>
                            <td><?= $inv->BillingState; ?></td>
                            <td><?= $inv->BillingCountry; ?></td>
                            <td><?= $inv->BillingPostalCode; ?></td>
                            <td><?= $inv->Total; ?></td>                            
                            <td>
                                <a href="edit_invoice.php?id=<?= $inv->InvoiceId?>" class="nav-link">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_invoice.php?id=<?= $inv->InvoiceId?>" class="nav-link-delete">Delete</a>
                            </td>
                        </tr>
                    <?php ;} ?>
                </tbody>                
            </table>
                <ul class="pagination">
                    <li><a href="?page=1">First</a></li>

                    <?php for($p=1; $p < $total_pages; $p++){ ?>
                        
                        <li class="<?= $page == $p ? 'active' : ''; ?>"><a href="<?= '?page='.$p; ?>"><?= $p; ?></a></li>
                    <?php }?>
                    <li><a href="?page=<?= $total_pages; ?>"> Last</a></li>                           
                        
                </ul>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    