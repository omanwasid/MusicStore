<?php
require_once __DIR__.'../services/ServiceCustomer.php';

$cartItems=array();
 if(isset($_COOKIE['PHPSESSID'])){
   session_id($_COOKIE['PHPSESSID']);
   session_start();

  if(isset($_SESSION['cart'])){
      //print_r($_SESSION['cart']);
      $cartItems=$_SESSION['cart'];
    }
 }

$service = new CustomerService; 
$customer=$service->GetCustomerById($_SESSION['userID']);


require 'header.php';
?>
<div class="container">
    <table class="table table-bordered">
                <thead>
                    <tr>                        
                        <th>Name</th>
                        <th>UnitPrice</th>                   
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartItems as $val)                     
                    {?>
                        
                        <tr>
                            <td><?= $val['value']['name'] ?></td>
                            <td><?= $val['value']['unitPrice'] ?></td>
                            <td><?= $val['value']['qty']?></td>   
                            <td><?= $val['value']['total'] ?></td>                           
                        </tr>
                    <?php } ?>
                </tbody>                
            </table>
            <div>Delivery info</div>

               <form method="POST" action="purchage.php">                
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
                    <button type="submit" class="btn btn-info">Purchage</button>
                </div>

            </form>
            
</div>
 
<?php require 'footer.php';?>

    