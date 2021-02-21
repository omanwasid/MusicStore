<?php
require_once __DIR__.'../services/ServiceInvoiceLine.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new InvoiceLineService;
$total_pages = $service->GetTotalInvoiceLineCount($limit);

$invoiceline = $service->GetInvoiceLines($page);
?>

<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Invoiceline</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="tablehead">
                        <th>Invoice Line ID</th>
                        <th>Invoice ID</th>
                        <th>Track ID</th>                   
                        <th>Unit Price</th>
                        <th>Quantity</th>                                             
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($invoiceline as $line) {?>                        
                        <tr>
                            <td><?= $line->InvoiceLineId; ?></td>
                            <td><?= $line->InvoiceId; ?></td>
                            <td><?= $line->TrackId; ?></td>   
                            <td><?= $line->UnitPrice; ?></td>
                            <td><?= $line->Quantity; ?></td>                                                     
                            <td>
                                <a href="edit_invoiceline.php?id=<?= $line->InvoiceLineId?>" class="nav-link">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_invoiceline.php?id=<?= $line->InvoiceLineId?>" class="nav-link-delete">Delete</a>
                            </td>
                        </tr>
                    <?php $no++;} ?>
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

    