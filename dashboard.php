<?php
require 'db_connection.php';
session_start();
// echo $_SESSION['admin_id'];
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admin_table WHERE admin_id = $admin_id";
$con = $db_connection->query($query);
// print_r($con);
$user = $con->fetch_assoc();
// print_r($user);

$profile_pic = $user["profile_pic"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="w-full md:w-2/5 mx-auto">
        <h3 class="text-xl md:text-3xl">Welcome, <?php echo $user['first_name'] ?></h3>

        <div>
            <form action="submit_file.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_SESSION['upload_success'])) {
                echo '<div class="text-green-500 text-center my-3 bg-green-100 h-16 flex items-center justify-center rounded-lg font-semibold">' . $_SESSION['upload_success'] . '</div>';
            }
            unset($_SESSION['upload_success']);
            if (isset($_SESSION['upload_error'])) {
                echo '<div class="text-red-500 text-center my-3 bg-red-100 h-16 flex items-center justify-center rounded-lg font-semibold">' . $_SESSION['upload_error'] . '</div>';
            }
            unset($_SESSION['upload_error']);
            ?>
                <input type="file" name="image" class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3">
                <input type="submit" name="submit" value="Upload Profile Pic" class="w-full h-16 text-lg font-semibold my-3 bg-blue-700 text-white rounded-lg cursor-pointer transition hover:opacity-80">
            </form>
        </div>

        <div>
            <img src=<?php echo "images/" . $profile_pic ?>  alt="Profile Pic" class="w-32 rounded-full">
        </div>
    </div>
</body>
</html>