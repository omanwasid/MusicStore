<?php
require_once __DIR__.'/ServiceInvoiceLine.php';

$id = $_GET['id'];
$service = new InvoiceLineService;
if ($service->DeleteInvoiceLine($id)) {
    header("Location: indexForInvoiceline.php");
}
?>