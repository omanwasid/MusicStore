<?php
require_once __DIR__.'/ServiceInvoice.php';

$id = $_GET['id'];
$service = new InvoiceService;
if ($service->DeleteInvoice($id)) {
    header("Location: indexForInvoice.php");
}
?>