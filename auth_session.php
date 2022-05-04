<?php
//include auth_session.php file on all user panel pages
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
