
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/customer.js"></script>
    <title>Customer</title>
    <script>
      $(document).ready(function() {
        getAllCustomers();        
      });
    </script>
</head>
<?php

    $host = "localhost";
    $db_name = "chinook_abridged";
    $username = "root";
    $password = "";
    $conn;
    
    getConnection();
    function getConnection(){
    global $conn;      
    global $host;
    global $db_name;
    global $username;
    global $password ;
       
        try{
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn;
    }

$sql = "SELECT * FROM artist";
$stmt = $conn->prepare($sql);
$stmt->execute();
$artist = $stmt->fetchAll(PDO::FETCH_OBJ);
print_r(json_encode($artist));

?>

