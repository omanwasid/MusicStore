<?php
require_once __DIR__.'/serviceCustomer.php';
$id = $_GET['id'];
$service = new CustomerService;
if ($service->DeleteCustomer($id)) {
    header("Location: indexForCustomer.php");
}
?>