<?php
require_once __DIR__.'/db.php';

class CustomerService{

    function GetCustomers($pageNo){
        $connection = Connect::GetConnection();
        $limit = 20;
        // count total number of rows in customer table
        $count_query = "SELECT * FROM customer";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        $start = ($pageNo-1) * $limit;

        // query to get customers from customer table
        $sql = "SELECT * FROM customer LIMIT $start, $limit";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $customer;
}

    function GetTotalCustomersCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM customer";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }

    //use for REST API LATER
    function GetCustomersApi($pageNo)
    {
      header('Content-Type: application/json');
      echo json_encode($this->GetCustomers($pageNo));
    }

    function GetCustomerById($id){
          $connection = Connect::GetConnection();
          $sql ='SELECT * FROM customer WHERE CustomerId = :id';
          $stmt = $connection->prepare($sql);
          $stmt->execute([':id' => $id]);
          $customer = $stmt->fetch(PDO::FETCH_OBJ);
        return $customer;
    }

    function UpdateCustomer($fname, $lname, $password
                                  ,$company,$address,$city, $state, 
                                  $country, $postalcode,  $phone,$fax
                                  ,$email,$id){
    $connection = Connect::GetConnection();
    $sql = "UPDATE `customer` SET `FirstName`= :fname,`LastName`= :lname,
    `Password`= :password,`Company`= :company,`Address`= :address,`City`= :city,`State`= :state,
    `Country`= :country,`PostalCode`= :postalcode,`Phone`= :phone,`Fax`= :fax,`Email`= :email 
    WHERE CustomerId = :id";
    $stmt = $connection->prepare($sql);

    if ($stmt->execute([':fname'=> $fname, ':lname'=> $lname, ':password'=> $password,
        ':company'=> $company, ':address'=> $address, ':city'=> $city, ':state'=> $state, 
        ':country'=> $country, ':postalcode'=> $postalcode, ':phone'=> $phone,
        ':fax'=> $fax, ':email'=> $email, ':id' => $id])) {
            return true;
        }
        return false;
    }

    function DeleteCustomer($id){
    $connection = Connect::GetConnection();
    $sql = 'DELETE FROM customer WHERE CustomerId = :id';
    $stmt = $connection->prepare($sql);
    return $stmt->execute([':id' => $id]);
    }
}

?>
