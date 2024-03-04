<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';
$user_data = $_SESSION;
check_login($user_data);
check_admin($user_data['role']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/management_style.css" />
    <!-- Icons Fontawesome -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <!-- Navbar -->
    <header>
      <?php include_once './navbar.html'; ?>
    </header>
    <!-- /Navbar -->

    <!-- Main -->
    <main>
      <section class="banner">
        <div class="container">
          <div class="title"><h1>Administration Panel:</h1></div>
          <table class="table-content">
            <thead>
              <tr>
                <th class="invisible">id</th>
                <th>NAME</th>
                <th>SURNAME</th>
                <th>USERNAME</th>
                <th>EMAIL</th>
                <th>ROLE</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <?php print_users($con); ?>
          </table>
        </div>
      </section>
    </main>
    <!-- /Main -->

    <!-- Footer -->
    <footer>
      <?php include_once './footer.html'; ?>
    </footer>
    <!-- /Footer -->

    <!-- Scripts -->
    <script src="../../javascript/admin.js"></script>
    <!-- /Scripts -->
  </body>
</html>


