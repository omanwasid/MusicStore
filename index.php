
<?php
 session_start();    
    if (isset($_SESSION['userID'])) {    
        require 'header.php';  
    }else{
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    
    <link rel="stylesheet" href="css/styles.css"></style>
    <title>Music Store!</title>
  </head>
  <body class="bg-info">
    <div id="design">
      <nav class="navbar"> 

          <div align="center" class="navbarCollapse" id="navbarSupport"><br>
    
          <a class="login" href="login.php">Login</a>      
          </div>
    </nav>
    <?php }?>

  <div align="center" class="container">
        <h1 > Online Music Store</h1>    
  </div>

  <a href="img/music.png" style='text-align: center;'>
    <img src="img/music.png" alt="Music"  height="400" width="764">
  </a>
    </div>
  </body>
<?php include_once('footer.htm');?>