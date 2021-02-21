<?php
    require_once __DIR__.'../../services/ServiceInvoiceLine.php';
    
        if (!isset($_REQUEST['action'])) {
            return;            
        } else {         
         header('Content-Type: application/json');
            $action = $_REQUEST['action'];
            switch ($action) {
              case 'getAllInvoiveLines':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new InvoiceLineService;
                $limit = 20;
                $invoiceline=$service->GetInvoiceLines($page);
                $total_pages=$service->GetTotalInvoiceLineCount($limit);
                $invoiceline['total']=$total_pages;
                $invoiceline['page']=$page;
                echo json_encode($invoiceline);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new InvoiceLineService;                
                if($service->DeleteInvoiceLine($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':
                $result=array('status'=>'1', 'message'=>'create successful');

                if (isDataValid()) {
                  $invoiceId =$_POST['invoiceId'];
                  $trackId = $_POST['trackId'];
                  $unitPrice = $_POST['unitPrice'];
                  $quantity = $_POST['quantity'];

                  $service = new InvoiceLineService;
                  if ($service->InsertInvoiveLine($invoiceId, $trackId, $unitPrice, $quantity)) 
                  {
                    $result['message'] = 'success';
                  } else {
                    $result['message'] = 'failled';
                  }
                } else {
                  $result['message'] = 'field required';
                }

                echo json_encode($result);
              break;
              case 'edit':
                $id = 1;
                $result = array('status'=>'1', 'message'=>'edit successful');
                if(isset($_POST['id'])) {
                  $id = $_POST['id'];
                } else {
                  $result['message'] = 'id required';
                  echo json_encode($result);
                }

                $service = new InvoiceLineService;
                $invoiceId =$_POST['invoiceId'];
                $trackId = $_POST['trackId'];
                $unitPrice = $_POST['unitPrice'];
                $quantity = $_POST['quantity'];

                if ($service->UpdateInvoiceLine($invoiceId, $trackId, $unitPrice, $quantity, $id)) 
                {
                  $invoiceline = $service->GetInvoiceLineById($id);
                  $invoiceline['message'] = 'successful';
                  echo json_encode($invoiceline);
                } else {
                  $result['message'] = 'failed';
                }
              break;
              case 'getInvoiceLineById':
                $id = 1;
                $result = array('status'=>'1', 'message'=>'successful');

                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new InvoiceLineService;
                $invoiceline = $service->GetInvoiceLineById($id);
                echo json_encode($invoiceline);
              break;
            }
        }

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
  
?>