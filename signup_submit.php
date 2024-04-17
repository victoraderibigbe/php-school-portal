<?php
require 'db_connection.php'; // Import file to connect with database

session_start(); // Initialize session to store message

// Authenticate user before rendering the page
if (isset($_POST['submit'])) {
    print_r($_POST);

    // Store individual data into variables
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phonenumber'];
    $department = $_POST['department'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_table WHERE email = '$email'";
    $connection = $db_connection->query($query);

    if ($connection->num_rows > 0) {
        $user = $connection->fetch_assoc();
        $_SESSION['message'] = 'Email already exists!';
        header('location:signup.php');
    } else {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT); // Convert password to hash
        // echo $hashedpassword;

        // Run query to save admin data into database
        $registerquery = "INSERT INTO admin_table (`first_name`, `last_name`, `email`, `phone_number`, `department`, `password`, `age`, `address`) VALUES ('$first_name','$last_name','$email','$phone_number','$department','$hashedpassword',$age,'$address')";

        $querycon = $db_connection->query($registerquery); // Connect with database connection file

        if ($querycon) {
            header('location:signin.php');
        } else {
            $_SESSION['failedmsg'] = 'Registration failed!';
            header('location:signup.php');
        }
    }


} else {
    header('location:signup.php');
}