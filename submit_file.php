<?php
require 'db_connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if (isset($_POST['submit'])) {
    print_r($_FILES['image']);

    $name = $_FILES['image']['name'];
    $path = $_FILES['image']['full_path'];
    $type = $_FILES['image']['type'];
    $tempname = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    echo '<br>';

    $newname = time() . $name;
    echo $newname;
    $move_image = move_uploaded_file($tempname, 'images/' . $newname);
    if ($move_image) {
        echo 'Image moved';
        $query = "UPDATE admin_table SET profile_pic = '$newname' WHERE admin_id = $admin_id";
        $con = $db_connection->query($query);

        if ($con) {
            $_SESSION['upload_success'] = 'Upload successful';
            header('location:dashboard.php');
        } else {
            $_SESSION['upload_error'] = 'Upload failed';
            header('location:dashboard.php');
        }
    } else {
        echo 'Image not moved';
    }
} else {
    header('location:dashboard.php');
}