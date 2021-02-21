<?php   
   /* require_once __DIR__.'../apiAuthentication.php';
    $authService=new AuthenticationService;
    if(!$authService->isAthenticateAndAthorize()){    
      $message=array('authenticate'=>false);
       echo json_encode($message);
       return ;
    }else{
      $message=array('authenticate'=>true,'authorize'=>false);
     // print_r($authService);
      if(!$authService->isAuthorized){
       echo json_encode($message);
        return;
      }
    }*/

    require_once __DIR__.'../../services/ServiceCustomer.php';

        if (!isset($_REQUEST['action'])) {
            return;            
        } else {            
         header('Content-Type: application/json');
            $action = $_REQUEST['action'];
            switch ($action) {
              case 'getAllCustomers':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new CustomerService;
                $limit = 20;
                $customer=$service->GetCustomers($page);
                $total_pages=$service->GetTotalCustomersCount($limit);
                $customer['total']=$total_pages;
                $customer['page']=$page;
                echo json_encode($customer);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new CustomerService;                
                if($service->DeleteCustomer($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':                
                $result=array('status'=>'1','message'=>'create sufull');
                
                if (isDataValid()) {        
                      $fname = $_POST['fname'];
                      $lname = $_POST['lname'];
                      $password = $_POST['password'];
                      $company = $_POST['company'];
                      $address = $_POST['address'];
                      $city = $_POST['city'];
                      $state = $_POST['state'];
                      $country = $_POST['country'];
                      $postalcode = $_POST['postalcode'];
                      $phone = $_POST['phone']; 
                      $fax = $_POST['fax']; 
                      $email = $_POST['email'];
                      
                      $service = new CustomerService;                
                      if($service->InsertCustomer($fname, $lname, $password, $company, $address, 
        $city, $state, $country, $postalcode, $phone, $fax, $email))
                        {
                          $result['message'] = 'success';
                        }else{
                          $result['message']='failed';
                        }
                  } else {
                      $result['message']='field required';
                  }

                
                echo json_encode($result);
              break;
              case 'edit':
                $email = 1;
                $result=array('status'=>'1','message'=>'edit succefull');
                if(isset($_POST['email'])){
                  $email =$_POST['email'];
                }else{
                  $result['message']='email required';
                  echo json_encode($result);
                }

                ///

                 $service = new CustomerService;                  
                      $fname = $_POST['fname'];
                      $lname = $_POST['lname'];
                      //$password = $_POST['password'];
                      $company = $_POST['company'];
                      $address = $_POST['address'];
                      $city = $_POST['city'];
                      $state = $_POST['state'];
                      $country = $_POST['country'];
                      $postalcode = $_POST['postalcode'];
                      $phone = $_POST['phone']; 
                      $fax = $_POST['fax']; 
                      $email = $_POST['email'];
        
                      if ($service->UpdateCustomer($fname, $lname, $company,$address,$city, $state, $country, $postalcode,  $phone,$fax,$email)) {

                           $customer=$service->GetCustomerByEmail($email);
                           $customer['message']='succeful';
                           echo json_encode($customer);
                       }else{
                           $result['message']='failed';
                          }
                  

                ///


              break;
              case 'getCustomerById':
                $id = 1;
                $result=array('status'=>'1','message'=>' succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new CustomerService;                
                echo json_encode($service->GetCustomerById($id));
              break;
              
            }
        }

        function isDataValid() {
          if (isset($_POST['fname']) && !empty($_POST['fname']) && isset($_POST['lname']) 
          && !empty($_POST['lname']) && isset($_POST['password']) && !empty($_POST['password']) 
          && isset($_POST['email']) && !empty($_POST['email'])) {
            return true;
            } else {
              return false;
            }
        }
  
?>