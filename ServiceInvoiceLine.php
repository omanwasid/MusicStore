<?php 
require_once __DIR__.'/db.php';

class InvoiceLineService
{
    function isDataValid()
    {
        if (isset($_POST['invoiceId']) && !empty($_POST['invoiceId']) && isset($_POST['trackId']) && 
        !empty($_POST['trackId']) && isset($_POST['unitPrice']) && !empty($_POST['unitPrice']) && 
        isset($_POST['quantity']) && !empty($_POST['quantity'])) 
        {   
            return true;
        } else {
            return false;
        }
    }

    
    function CreateInvoiceLine()
    {
        if(isDataValid()) 
        {
            $invoiceId = $_POST['invoiceId'];
            $trackId = $_POST['trackId'];
            $unitPrice = $_POST['unitPrice'];
            $quantity = $_POST['quantity'];
    
            InsertInvoiveLine($invoiceId, $trackId, $unitPrice, $quantity);
                
        }
    }  
    
    function InsertInvoiveLine($invoiceId, $trackId, $unitPrice, $quantity) 
    {
        $connection = Connect::GetConnection();
        global $message;

        try {        
            $sql = "INSERT INTO `invoiceline` (`InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`) VALUES(:invoiceId, :trackId, :unitPrice, :quantity)";
            $stmt = $connection->prepare($sql);
          
            if ($stmt->execute([':invoiceId'=> $invoiceId, ':trackId'=> $trackId, 
                ':unitPrice'=> $unitPrice, ':quantity'=> $quantity])) 
                {
                    $message = 'Data inserted successfully';
                }
            } catch(Exception $e) {
                //echo $e->getMessage();
                $message = 'Data not inserted';
            }
    }
    

    function GetInvoiceLines($pageNo) {
        $connection = Connect::GetConnection();
        $limit = 20;
    
        $start = ($pageNo-1) * $limit;
    
        // query to get Invoice Line from invoiceline table
        $sql = "SELECT * FROM invoiceline LIMIT $start, $limit";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $invoiceline = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $invoiceline;
    }

    function GetTotalInvoiceLineCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM invoiceline";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }

    function GetInvoiceLinesApi($pageNo)
    {
      header('Content-Type: application/json');
      echo json_encode($this->GetInvoiceLines($pageNo));
    }

    function GetInvoiceLineById($id) {
        $connection = Connect::GetConnection();    
        $sql ='SELECT * FROM invoiceline WHERE InvoiceLineId = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $invoiceline = $stmt->fetch(PDO::FETCH_OBJ);
        return $invoiceline;
    }

    function UpdateInvoiceLine($id, $invoiceId, $trackId, $unitPrice, $quantity) {
        $connection = Connect::GetConnection();
    
        $sql = "UPDATE `invoiceline` SET `InvoiceId`= :invoiceId,`TrackId`= :trackId,`UnitPrice`= :unitPrice,`Quantity`= :quantity WHERE InvoiceLineId = :id";
    
        $stmt = $connection->prepare($sql);
        if ($stmt->execute([':invoiceId'=> $invoiceId, ':trackId'=> $trackId, 
        ':unitPrice'=> $unitPrice, ':quantity'=> $quantity, ':id' => $id])) {
                return true;
            }
            return false;
    }

    function DeleteInvoiceLine($id) {
        $connection = Connect::GetConnection();
    
        $sql = 'DELETE FROM invoiceline WHERE InvoiceLineId = :id';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>