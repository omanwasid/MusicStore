<?php
require_once __DIR__.'../services/ServiceInvoice.php';
require_once __DIR__.'../services/ServiceInvoiceLine.php';

$cartItems=array();
 if(isset($_COOKIE['PHPSESSID'])){
   session_id($_COOKIE['PHPSESSID']);
   session_start();

  if(isset($_SESSION['cart'])){
      //print_r($_SESSION['cart']);
      $cartItems=$_SESSION['cart'];
    }
 }

    $billingAddress = $_POST['address'];
    $billingCity = $_POST['city'];
    $billingState = $_POST['state'];
    $billingCountry = $_POST['country'];
    $billingPostalCode  = $_POST['postalcode'];

  $invoice=null;
  $invoiceLine=null;

  $service = new InvoiceService; 
  if(!empty($cartItems)){
        $invoiceId=$service->Insert($_SESSION['userID'],$billingAddress, $billingCity, $billingState, $billingCountry
            , $billingPostalCode,$cartItems);

        if($invoiceId>0){
            $_SESSION['cart']='';
            $invoice=$service->GetInvoiceById($invoiceId);
            $InvoiceLineService = new InvoiceLineService; 
            $invoiceLine=$InvoiceLineService->GetInvoiceLineByInvoiceId($invoiceId);
        }
  }

require 'header.php';
//print_r($invoice);

?>
<div class="container">
<?php 
//print_r($invoice);
//print_r($invoiceLine);
if(!empty($invoice)){ ?>
<div>
INVOICEID: <span><?= $invoice->InvoiceId ?></span><br>
Invoice date: <span><?= $invoice->InvoiceDate ?></span><br>
Address: <span><?= $invoice->BillingAddress ?></span><br>
Total :<span><?= $invoice->Total ?></span><br>
</div>
<?php }?>


<?php 
//print_r($invoice);
//print_r($invoiceLine);
if(!empty($invoiceLine)){ ?>
<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>UNITprice</th>
                        <th>Quantity</th> 
                    </tr>
                </thead>
                <tbody>

      <?php foreach($invoiceLine as $val)                     
                    {?>
          <tr>
            <td><?= $val['Name'] ?></td>
            : <td><?= $val['UnitPrice'] ?></td>
            :<td><?= $val['Quantity'] ?></td> 
            <br>
          </tr>
<?php } }?>
            
</div>
 
<?php require 'footer.php';?>

    