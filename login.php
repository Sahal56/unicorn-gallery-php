<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <script type="text/javascript" src="validate.js"></script>
</head>

<body>
    <?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['submit'])) {
        $username = stripslashes($_POST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query); //or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form" method="post" name="loginForm" onsubmit="return validLoginForm()">
            <h1 class=" login-title">Login</h1>

            <span id="message1" style="color: red;"></span>
            <input type="text" class="login-input" id="username" name="username" placeholder="Username" autofocus="true" />

            <span id="message2" style="color: red;"></span>
            <input type="password" class="login-input" id="password" name="password" placeholder="Password" />

            <input type="submit" class="login-button" value="Login" name="submit" />
            <div class="link"><a href="registration.php">New Registration</a></div>
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