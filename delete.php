<?php
include("auth_session.php");
require('db.php');


if (isset($_POST) && !empty($_POST['id'])) {

    $id = $_POST['id'];
    $sql_select = "SELECT `image` FROM `image_gallery` WHERE id = " . $id;
    $select_result = mysqli_query($con, $sql_select);
    $row = mysqli_fetch_row($select_result);
    $image_name = $row[0];

    // code to unlink(delete)  image physically from folder 
    $unl = unlink("uploads/" . $image_name);

    $sql = "DELETE FROM `image_gallery` WHERE id = " . $id;
    $result = mysqli_query($con, $sql);

    $_SESSION['success'] = 'Image Deleted successfully.';
    header("Location: dashboard.php");
} else {
    $_SESSION['error'] = 'Image Not Deleted';
    echo "not deleted";
    header("Location: dashboard.php");
}
