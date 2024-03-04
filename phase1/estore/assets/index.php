<?php
session_start();
include './scripts/php/helper_scripts/connection.php';
include './scripts/php/helper_scripts/functions.php';
$error_login = '';

$errors_signup = [
  'username' => '',
  'email' => '',
];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Handling Login Process: Errors and actual connection
  if($_POST['submit'] =='Login'){
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    // Search in DB for the user with the inserted username
    // and password and check if confirmed
    $query = "SELECT ID FROM users WHERE USERNAME = '$username' && PASSWORD = '$password' && CONFIRMED = '1'";
    $res = mysqli_query($con, $query);
    // If there is a user with the given credentials
    if ($res && mysqli_num_rows($res) > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: ./scripts/php/main/welcome.php');
        die();
    } else {
        $error_login ='There is no user with the given username or password.';
    } 
  }
    // Handling Signup
    if($_POST['submit'] =='Signup'){
      
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $role = $_POST['role'];

      // Insert the new User in the DB
      $query = "INSERT INTO users(NAME,SURNAME,USERNAME,PASSWORD,EMAIL,CONFIRMED,ROLE) 
          VALUES('$name','$surname','$username','$password', '$email', 0, '$role')";

      mysqli_query($con, $query);
      header('Location: '.$_SERVER['PHP_SELF']);
      die();
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Estore</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/index_style.css" />
    <!-- Icons -->
     <!-- Icons Fontawsome -->
     <script
      src="https://kit.fontawesome.com/bfda754cdd.js"
      crossorigin="anonymous"
    ></script>
    <!-- Validation -->
    <script defer src="./scripts/javascript/index-valid.js"></script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  </head>

  <body>
    <div class="container">
      <input type="checkbox" id="flip" name = "flip" onclick="clearForm(this)" value=1 <?php if(isset($_POST['flip'])) echo "checked='checked'"; ?>  />
      <div class="cover">
        <div class="front">
          <img src="./_images/laptop-cart.jpg" alt="Cover-Image" />
          <div class="text">
            <span class="text-1">Hapiness can be found anywhere</span>
            <span class="text-2">Let's Find Happiness</span>
          </div>
        </div>
        <div class="back">
          <img
            class="backImg"
            src="./_images/laptop-card.jpg"
            alt="Cover-Image"
          />
          <div class="text">
            <span class="text-1">Ready to buy them all?</span>
            <span class="text-2">Let's Get Started!</span>
          </div>
        </div>
      </div>
      <div class="form-content">
         <!-- Login form -->
        <div class="login-form">
          <form method="post" id = "login-form">
            <div class="title">Login</div>
            <div class="textboxes">
              <div class="textbox">
                <!--Username field-->
                <input
                  type="text"
                  id = "username_login"
                  placeholder="Enter Username"
                  name="user_name"
                  required
                />
                <i class="fa-solid fa-user" id = "user_icon_login"></i>
              </div>
              <div class="red-text" id = "username_login_err">
              </div>

              <div class="textbox">
                <!--Password field-->
                <input
                  type="password"
                  id = "password_login"
                  placeholder="Enter Password"
                  name="password"
                  required
                />
                <i class="fa-solid fa-lock pass" id ="pass_icon_login"></i>
                <i
                  class="fa-solid fa-eye-slash show" id ="show_icon_login" onclick="toggleShow()"
                ></i>
              </div>
              <div class="red-text" id = "password_login_err">
              </div>

              <div class="textbox">
                <input
                  type="submit"
                  value="Login"
                  name="submit"
                  class="button"
                />
              </div>

              <div class="red-text" id ="submit_login_err">
                <?php echo $error_login; ?>
              </div>
            </div>

            <div class="options">
              <div class="signup-text">
                <!--Sign Up Link-->
                Don't have an account?<br />
                <label for="flip">Signup</label>
              </div>
            </div>
          </form>
        </div>
        <!-- Signup -->
        <div class="signup-form">
          <form method="post" id = "signup-form">
            <div class="title">Signup</div>

            <div class="textboxes">
              <div class="textbox">
                <input
                  type="text"
                  placeholder="Enter your name"
                  name="name"
                  id = "name_signup"
                  required
                />
                <i class="fa-regular fa-user"></i>
              </div>
              <div class="red-text" id="name_signup_err">
              </div>

              <div class="textbox">
                <input
                  type="text"
                  placeholder="Enter your surname"
                  name="surname"
                  id = "surname_signup"
                  required
                />
                <i class="fa-regular fa-user"></i>
              </div>

              <div class="red-text" id = "surname_signup_err">
              </div>

              <div class="textbox">
                <!--Username field-->
                <input
                  type="text"
                  placeholder="Enter Username"
                  name="username"
                  id = "username_signup"
                  required
                />
                <i class="fa-solid fa-user"></i>
              </div>
              <div class="red-text" id = "username_signup_err">
              </div>

              <div class="textbox">
                <input
                  type="password"
                  id = "password_signup"
                  placeholder="Enter Password"
                  name="password"
                  required
                />
                <i class="fa-solid fa-lock pass"></i>
              </div>
              <div class="red-text" id ="password_signup_err">
              </div>

              <div class="textbox">
                <input
                  type="password"
                  id ="conf_password_signup"
                  placeholder="Confirm yor Password"
                  name="conf_password"
                  required
                />
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <div class="red-text" id = "conf_password_signup_err">
              </div>

              <div class="textbox">
                <input
                  type="text"
                  placeholder="Enter your email"
                  name="email"
                  id = "email_signup"
                  required
                />
                <i class="fa-solid fa-envelope"></i>
              </div>
              <div class="red-text" id = "email_signup_err">
                <?php echo $errors_signup['email']; ?>
              </div>

              <div class="role_details">
                <input
                  type="radio"
                  name="role"
                  id="dot-1"
                  value="User"
                  required
                />
                <input type="radio" name="role" id="dot-2" value="Seller" />
                <input type="radio" name="role" id="dot-3" value="Admin" />
            
                <div class="category">
                  <label for="dot-1">
                    <span class="dot one"> </span>
                    <span class="role_type">User</span>
                  </label>
                  <label for="dot-2">
                    <span class="dot two"> </span>
                    <span class="role_type">Seller</span>
                  </label>
                  <label for="dot-3">
                    <span class="dot three"> </span>
                    <span class="role_type">Administrator</span>
                  </label>
                </div>
              </div>

              <div class="textbox">
                <input
                  type="submit"
                  value="Signup"
                  name="submit"
                  class="button"
                />
              </div>
            </div>

            <div class="options">
              <div class="signup-text">
                <!--Sign Up Link-->
                Already have an account? <br />
                <label for="flip">Login</label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="./scripts/javascript/index.js"></script>
  </body>
</html>
