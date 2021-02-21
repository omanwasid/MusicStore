<?php
    require_once __DIR__.'../../services/ServiceInvoice.php';


    
        if (!isset($_REQUEST['action'])) {
            return;            
        } else {       
         header('Content-Type: application/json');
            $action = $_REQUEST['action'];                

            switch ($action) {
              case 'add': 
               require_once __DIR__.'../../services/ServiceTrack.php';
                  addToCart();
              break;
              case 'remove': 
               require_once __DIR__.'../../services/ServiceTrack.php';
                  removeFromCart();
              break;
              case 'getAllInvoices':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new InvoiceService;
                $limit = 20;
                $invoice=$service->GetInvoices($page);
                $total_pages=$service->GetTotalInvoicesCount($limit);
                $invoice['total']=$total_pages;
                $invoice['page']=$page;
                echo json_encode($invoice);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new InvoiceService;                
                if($service->DeleteInvoice($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':
                $result=array('status'=>'1','message'=>'create sufull');

                if (isDataValid()) {
                  $customerId = $_POST['customerId'];
                  $invoiceDate = $_POST['invoiceDate'];
                  $billingAddress = $_POST['billingAddress'];
                  $billingCity = $_POST['billingCity'];
                  $billingState = $_POST['billingState'];
                  $billingCountry = $_POST['billingCountry'];
                  $billingPostalCode = $_POST['billingPostalCode'];
                  $total = $_POST['total'];

                  $service = new InvoiceService;
                  if ($service->InsertInvoice($customerId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $total)) 
                  {
                    $result['message'] = 'success';
                  } else {
                    $result['message'] = 'failed';
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

                $service = new InvoiceService;
                $customerId = $_POST['customerId'];
                  $invoiceDate = $_POST['invoiceDate'];
                  $billingAddress = $_POST['billingAddress'];
                  $billingCity = $_POST['billingCity'];
                  $billingState = $_POST['billingState'];
                  $billingCountry = $_POST['billingCountry'];
                  $billingPostalCode = $_POST['billingPostalCode'];
                  $total = $_POST['total'];

                  if ($service->UpdateInvoice($customerId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $total, $id)) 
                  {
                    $invoice = $service->GetInvoiceById($id);
                    $invoice['message'] = 'successful';
                    echo json_encode($invoice);
                  } else {
                    $result['message'] = 'failed';
                  }
                break;
                case 'GetInvoiceById':
                  $id = 1;
                $result = array('status'=>'1', 'message'=>'successful');

                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }
                
                $service = new InvoiceService;
                $invoice = $service->GetInvoiceById($id);
                echo json_encode($invoice);
              break;
            }
        }

        function isDataValid() 
        {
            if (isset($_POST['customerId']) && !empty($_POST['customerId']) && isset($_POST['invoiceDate']) && 
            !empty($_POST['invoiceDate']) && isset($_POST['total']) && !empty($_POST['total'])) 
            {
                return true;
            } else {
                return false;
            }
        }

        function addToCart() 
        {
         if(isset($_COOKIE['PHPSESSID'])){
                  session_id($_COOKIE['PHPSESSID']);
                  session_start();

            $id=$_GET['id'];
            $service = new TrackService;
            $track = $service->GetTrackById($id);            
            if($track!=null){
             $record=array('ID'=>$track->TrackId,'value'=>array('name'=>$track->Name,'unitPrice'=>$track->UnitPrice,'qty'=>1,'total'=>$track->UnitPrice));
             if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $alldata=$_SESSION['cart'];
               $newVale=array();
               $isfound=false;
               $i=0;
                foreach ($alldata as $val) {
                 
               //  print_r($val['ID']);
                 //print_r($val['value']);
               //  echo $val;
                if($val['ID']==$record['ID']){
                    $isfound=true;
                  //  echo $val['value']['qty'];
                    $val['value']['qty'] +=1;
                    $val['value']['total'] +=$val['value']['unitPrice'];                  
                  // print_r($val);
                    $newVale[$i++]=$val;
                 }else{
                  $newVale[$i++]=$val;
                 }
                }

                //print_r($alldata);

                if(!$isfound)
                  $newVale[$i++]=$record;

                $_SESSION['cart'] = $newVale;
             }else{
                $_SESSION['cart'] = array($record);
              }
              
            }
            echo json_encode($_SESSION['cart']);
         }
        }

          function removeFromCart() 
        {
          $newVale=array();
          if(isset($_COOKIE['PHPSESSID']))
          {
                  session_id($_COOKIE['PHPSESSID']);
                  session_start();

            $id=$_GET['id'];
             if(isset($_SESSION['cart'])) 
             {
                $alldata=$_SESSION['cart'];
             
               $isfound=false;
               $i=0;
                foreach ($alldata as $val) 
                {                 
                  if($val['ID']==$id)
                  {                                      
                      $val['value']['qty'] -=1;
                      $val['value']['total'] -=$val['value']['unitPrice'];                                    
                      if($val['value']['qty']>0)
                      {
                         $newVale[$i++]=$val;
                          $isfound=true;
                      }
                   }else{
                       $newVale[$i++]=$val;
                    }
                }
            }
            }
            $_SESSION['cart'] = $newVale;
            echo json_encode($_SESSION['cart']);
         }
        
?>