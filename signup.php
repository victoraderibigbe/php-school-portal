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
          Admin Register Form
        </h1>
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
          echo '<div class="text-red-500 text-center my-3 bg-red-100 h-16 flex items-center justify-center rounded-lg font-semibold">' . $_SESSION['message'] . '</div>';
          session_unset();
        }
        if (isset($_SESSION['failedmsg'])) {
          echo '<div class="text-red-500 text-center my-3 bg-red-100 h-16 flex items-center justify-center rounded-lg font-semibold">' . $_SESSION['failedmsg'] . '</div>';
          session_unset();
        }
        ?>
        <form action="signup_prepare.php" method="post">
          <input
            type="text"
            placeholder="First name"
            name="firstname"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="text"
            placeholder="Last name"
            name="lastname"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="email"
            placeholder="Email"
            name="email"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="text"
            placeholder="Phone number"
            name="phonenumber"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="text"
            placeholder="Department"
            name="department"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="text"
            placeholder="Age"
            name="age"
            class="w-full h-16 text-lg my-3 rounded-lg border border-slate-800 p-3"
            required
          />
          <input
            type="text"
            placeholder="Address"
            name="address"
            class="w-full h-62 text-lg my-3 rounded-lg border border-slate-800 p-3"
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
