<?php
require('db.php');
include("auth_session.php");

if (isset($_POST) && !empty($_FILES['image']['name']) && !empty($_POST['title'])) {

    $name = $_FILES['image']['name'];
    $title = $_POST['title'];
    list($txt, $ext) = explode(".", $name);
    $image_name = time() . "." . $ext;
    $tmp = $_FILES['image']['tmp_name'];

    if (move_uploaded_file($tmp, 'uploads/' . $image_name)) {

        $sql = "INSERT INTO `image_gallery` (`title`, `image`) VALUES ('" . $title . "', '" . $image_name . "')";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $_SESSION['success'] = 'Image Uploaded successfully.';
            header("Location: dashboard.php"); // used for redirection

        } else {
            $_SESSION['error'] = 'image uploading failed in database';
            header("Location: dashboard.php");
        }
    } else {
        $_SESSION['error'] = 'image uploading failed both in database and directory';
        header("Location: dashboard.php");
    }
} else {
    $_SESSION['error'] = 'Please Select Image or Write title';
    header("Location: dashboard.php");
}
