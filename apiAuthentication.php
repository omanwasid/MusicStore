<?php
 require_once __DIR__.'../../services/user.php';

 class AuthenticationService
{
    public bool $isAuthorized;
    
    function getCredentialsFromAuthentications(){
      $headers = apache_request_headers();
      if (isset($headers['Authorization'])) {
        $authorization=$headers['Authorization'];
        $splitAuthorization= explode (' ',$authorization);
        $decodeCredentials=explode(':',base64_decode($splitAuthorization[1]));
        
        return $decodeCredentials;
        }

        return '';
    }

    function isAthenticateAndAthorize(){      
        $this->isAuthorized=false;
        $credentials=$this->getCredentialsFromAuthentications();
        if(empty($credentials))
        return false;

        $user = new User();
        $validUser = $user->validate($credentials[0], $credentials[1]);
        if($validUser){
          if($user->isAdmin){
           $this->isAuthorized=true; 
           return true;
          }

          if (isset($_REQUEST['action'])) {
            switch ($_REQUEST['action']) {
              case 'getAllCustomers':
                $this->isAuthorized=true;
              break;
             }
          }
          return true;
        }
        return false;
    }
 }

?>