<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <script type="text/javascript" src="validate.js"></script>
</head>

<body>
    <?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['submit'])) {
        // removes backslashes
        $username = stripslashes($_POST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");

        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form" action="registration.php" method="post" name="registrationForm" onsubmit="return validRegForm()">
            <h1 class="login-title">Registration</h1>
            <input type="text" class="login-input" id="username" name="username" placeholder="Username" />
            <br><span id="message"></span>
            <input type="text" class="login-input" id="email" name="email" placeholder="Email Adress" />
            <br><span id="message"></span>
            <input type="password" class="login-input" id="password" name="password" placeholder="Password" />
            <br><span id="message"></span>
            <input type="submit" name="submit" value="Register" class="login-button">
            <p class="link"><a href="login.php">Click to Login</a></p>
            <br>
            <br>
            <br>
            <div class="link">
                <a href='index.html'>
                    <input type="button" class="home" value="HOME" name="submit" />
                </a>
            </div>
        </form>
    <?php
    }
    ?>
</body>

</html>