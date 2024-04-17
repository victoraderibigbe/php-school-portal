<?php
session_start();
require 'db_connection.php';

if (isset($_POST["submit"])) {
    // print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_table WHERE email=?";
    $prepare = $db_connection->prepare($query);
    $prepare->bind_param('s', $email);
    $execute = $prepare->execute();
    if ($execute) {
        $result = $prepare->get_result();
        // print_r($result);
        if ($result->num_rows > 0) {
            // echo 'User exists';
            $user = $result->fetch_assoc();
            // print_r($user);
            $hashedpassword = $user['password'];
            // echo $hashedpassword;
            $passwordverify = password_verify($password, $hashedpassword);
            if ($passwordverify) {
                echo 'User found';

            } else {
                echo 'Incorrect password';
            }
        } else {
            echo 'User does not exist';
        }
    } else {
        echo 'Not executed';
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