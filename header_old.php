<?php
error_reporting(E_ERROR | E_PARSE);    
session_start();    

    if (!isset($_SESSION['userID'])) {    
        header('Location: index.php');
    }
    $userID = $_SESSION['userID'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $email = $_SESSION['email'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['userID'])) { ?>   
          var username='<?= $_SESSION['email'] ?>';
          var password='<?= $_SESSION['password'] ?>';
        <?php } ?>

    </script>

    <script src="js/customer.js"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><br>
    <link rel="stylesheet" href="styles.css"></style>
    <title>Music Store!</title>
  </head>
  <body class="bg-info">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php 
        if($_SESSION['isAdmin']==true) {?>
          <li class="nav-item">
          <a class="nav-link" href="indexForCustomer.php">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexForAlbum.php?eh">Albums</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexForArtist.php?eh">Artist</a>
        </li>
      <?php } ?>
        <?php if (isset($_SESSION['userID'])) {?>
          <li class="nav-item">
            <a class="nav-link"  href='indexForTrack.php?eh'>Track</a>
            </li>
            <li class="nav-item">
            <a class="nav-link"  href='customerMain.php'>Search</a>
            </li>
          <li class="nav-item">
            <div id="divUserName">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?="$firstName $lastName".'('.$email.')' ?></div>
          </li>
          <li class="nav-item">
              <form id="frmLogout" action="login.php" method="POST">
                    <input type="hidden" name="logout" value="logout" />
                    <input type="submit" id="btnLogOut" value="Log Out" />&nbsp;
                </form>
            </li>
        <?php } ?>

      
    </ul>
    </div>
</nav>