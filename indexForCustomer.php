<?php

require_once __DIR__.'../services/ServiceCustomer.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$limit = 20;
$service = new CustomerService;
$customer=$service->GetCustomers($page);
$total_pages=$service->GetTotalCustomersCount($limit);
//$start = ($page-1) * $limit;
//$no = $page > 1 ? $start+1 : 1;

?>

<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Customer</h2>
        </div>
        <div class="card-header">
            <a href='create_customer.php'><h5>Add New Customer</h5><a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead >
                    <tr class="tablehead">
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>                   
                        <th>Company</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th>Phone</th>
                        <th>Fax</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customer as $person) {?>
                        
                        <tr class="tablehead" id='row<?= $person->CustomerId?>'>
                            <td><?= $person->CustomerId; ?></td>
                            <td><?= $person->FirstName; ?></td>
                            <td><?= $person->LastName; ?></td>   
                            <td><?= $person->Company; ?></td>
                            <td><?= $person->Address; ?></td>
                            <td><?= $person->City; ?></td>
                            <td><?= $person->State; ?></td>
                            <td><?= $person->Country; ?></td>
                            <td><?= $person->PostalCode; ?></td>
                            <td><?= $person->Phone; ?></td>
                            <td><?= $person->Fax; ?></td>
                            <td><?= $person->Email; ?></td>
                            <td>
                                
                                <a href="edit_customer.php?id=<?= $person->CustomerId?>" class="nav-link">Edit</a>
                                
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_customer.php?id=<?= $person->CustomerId?>" class="nav-link-delete">Delete</a>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>                
            </table>
                <ul class="pagination">
                    <li><a href="?page=1">First</a></li>

                    <?php for($p=1; $p < $total_pages; $p++){ 
                      $showPageNumber=$p+1;  
                    ?>
                        
                        <li class="<?= $page == $showPageNumber ? 'active' : ''; ?>">
                        <a href="<?= '?page='.$showPageNumber ?>">
                        <?= $showPageNumber ?></a></li>
                    <?php }?>
                    <li><a href="?page=<?= $total_pages; ?>"> Last</a></li>                     
                        
                </ul>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    