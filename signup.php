<?php
    require_once('src/functions.php');
    debug($_POST);

    $showForm = true;

    // New user
    if (isset($_POST['firstName'])) {
        $showForm = false;

        require_once('src/user.php');

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();
        $userCreated = $user->create($firstName, $lastName, $email, $password);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/signup.js"></script>
</head>
<body>
    <header>
        <h1>Films</h1>
    </header>
    <main>
        <?php
            if ($showForm) {
        ?>
        <form id="frmSignup" action="signup.php" method="POST">
            <fieldset>
            <legend>Sign up</legend>
                <label for="txtFirstName">First Name</label>
                <input type="text" id="txtFirstName" name="firstName" required>
                <br>
                <label for="txtLastName">Last Name</label>
                <input type="text" id="txtLastName" name="lastName" required>
                <br>
                <label for="txtEmail">Email</label>
                <input type="text" id="txtEmail" name="email" required>
                <br>
                <label for="txtPassword">Password</label>
                <input type="password" id="txtPassword" name="password" required>
                <br>
                <input type="submit" id="btnSignUp" value="Sign Up">
                <input type="button" id="btnSignUpCancel" value="Cancel">
            </fieldset>
        </form>
        <?php 
            } else {
                if ($userCreated) {
        ?>
        <div>
            The user was successfully created.
            <br>
            <a href="login.php" alt="Login">Back</a>
        </div>
        <?php
                } else {
        ?>
        <div>
            A user registered with this email address already exists.
            <a href="signup.php" alt="Sign Up">Back</a>
        </div>
        <?php 
                }
            }
        ?>
    </main>
    <?php
        include_once('footer.htm');
    ?>
</body>
<script src="js/signup.js"></script>
</html>