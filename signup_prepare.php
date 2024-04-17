<?php
require 'db_connection.php';

if (isset($_POST['submit'])) {
    print_r($_POST);

    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phonenumber'];
    $department = $_POST['department'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_table WHERE email=?";
    $prepare = $db_connection->prepare($query);
    $prepare->bind_param('s', $email);
    $execute = $prepare->execute();

    if ($execute) {
        $row = $prepare->get_result();

        if ($row->num_rows > 0) {
            echo 'Email already exists';
        } else {
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            // echo $hashedpassword;

            // Prepare stage
            $query = "INSERT INTO admin_table (`first_name`, `last_name`, `email`, `phone_number`, `department`, `password`, `age`, `address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $prepare = $db_connection->prepare($query);

            // Binding stage
            $prepare->bind_param('ssssssis', $first_name, $last_name, $email, $phone_number, $department, $hashedpassword, $age, $address);

            // Execution stage
            $execute = $prepare->execute();

            if ($execute) {
                echo 'Query executed';

            } else {
                echo 'Query not executed';
            }
        }
    } else {
        echo 'Not exectuted';
    }
} else {
    header('location:signup.php');
}