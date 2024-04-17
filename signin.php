<?php
require 'db_connection.php';
session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $query = "SELECT * FROM admin_table WHERE email = '$email'";

  $con = $db_connection->query($query);

  if ($con->num_rows > 0) {
    // echo 'email exists';
    $user = $con->fetch_assoc();
    // print_r($user);
    $hashedpassword = $user['password'];
    $adminId = $user['admin_id'];
    $password_verify = password_verify($pass, $hashedpassword);

    if ($password_verify) {
      // echo $password_verify;
      echo '<div class="text-center text-green-500">Password is correct</div>';
      $_SESSION['admin_id'] = $adminId;
      header('location:dashboard.php');
    } else {
      echo '<div class="text-center text-red-500">Incorrect Password</div>';
    }
  } else {
    echo '<div class="text-center text-red-500">Email does not exist</div>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div class="w-full md:w-2/5 mx-auto p-3 mt-5">
      <div class="shadow p-3 rounded-lg">
        <h1 class="text-center text-blue-700 font-bold text-2xl md:text-3xl underline">
          Admin Login
        </h1>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <input
            type="email"
            placeholder="Email"
            name="email"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="password"
            placeholder="Password"
            name="password"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="submit"
            name="submit"
            class="w-full h-16 text-lg font-semibold my-3 bg-blue-700 text-white rounded-lg cursor-pointer transition hover:opacity-80"
          />
        </form>
      </div>
    </div>
  </body>
</html>
