<?php
    //require_once('src/functions.php');
    session_start();  
    //debug($_SESSION);

    $userValidation = false;    

    // If the user has clicked on 'Logout', the session is destroyed
    if (isset($_POST['logout'])) { 
        session_destroy();
        header('Location: index.php');
    // If the user is already logged in, s/he is redirected to the search page
    } else if (isset($_SESSION['userID'])) {    
        header('Location: index.php');

    // If the user has filled the login fields, the authentication process is launched
    } else if (isset($_POST['email'])) {
        
        $userValidation = true;
        require_once('src/user.php');

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
     
        $validUser = $user->validate($email, $password);
        
        if ($validUser) {
            $_SESSION['userID'] = $user->userID;
            $_SESSION['firstName'] = $user->firstName;
            $_SESSION['lastName'] = $user->lastName;
            $_SESSION['email'] = $email;
            $_SESSION['isAdmin']=$user->isAdmin;
            $_SESSION['password']=$password;
            header('Location: index.php');
        }
    }

?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
      <header>
        <h1 align="center">Online Music store</h1>
    </header>
     <main>
        <?php
            if ($userValidation && !$validUser) 
            { ?>
              <div class="errorMessage">
                  Invalid email or password.
              </div>
        <?php } ?>
        <form id="frmLogin" action="login.php" method="POST">
            <fieldset><br>
            <legend align="center">Login</legend>
                <label for="txtEmail">Email</label>
                <input type="email" id="txtEmail" name="email" required>
                <br>
                <label for="txtPassword">Password</label>
                <input type="password" id="txtPassword" name="password" required>
                <br>
                <span style='text-align:center;float:left;width:100%;'>
                <input type="submit" id="btnLogin" value="Login">
                <span>
            </fieldset>
        </form>
        <div id="signup">
            If you do not have a user, you can <a href="create_customer.php">sign up</a>
        </div>
     </main>
    
<?phpinclude_once('footer.php');?>