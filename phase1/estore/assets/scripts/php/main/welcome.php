<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome Page</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/welcome_style.css" />
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body>
    <!-- Header -->
    <header>
      <?php include './navbar.html'; ?>
    </header>
    <!-- /Header -->

    <!-- Main -->
    <main>
      <!-- Banner with background Image -->
      <section class="banner">
        <div class="container">
          <h1>
            The whole world <br class="phone" />
            within <span class="change-clr">your grasp</span>
          </h1>
          <h3>
            Everything you need in the best<br />
            prices imaginable
          </h3>
          <a href="#products" class="button">Find out more</a>
        </div>
      </section>
      <!-- /Banner with background Image -->

      <!-- Products Preview -->
      <section class="products" id="products">
        <div class="container">
          <h2>Best Sellers</h2>
          <div class="products-grid">
            <div class="product">
              <figure class="img-box">
                <img
                  src="../../../_images/products/jacket.jpg"
                  alt="product_1"
                  class="img"
                />
              </figure>
              <div class="content">
                <h3>Jackets</h3>
                <p>
                  Explore Our Jackets Now &emsp;<a
                    href="./products.php"
                    class="button"
                    >Explore</a>
                </p>
              </div>
            </div>
            <div class="product">
              <figure class="img-box">
                <img
                  src="../../../_images//products/jeans.jpg"
                  alt="product_2"
                  class="img"
                />
              </figure>
              <div class="content">
                <h3>Trousers</h3>
                <p>
                  Explore Our Trousers<br class="show-mob" />
                  Now &emsp;<a href="./products.php" class="button">Explore</a>
                </p>
              </div>
            </div>
            <div class="product">
              <figure class="img-box">
                <img
                  src="../../../_images/products/shoe2.jpg"
                  alt="product_3"
                  class="img"
                />
              </figure>
              <div class="content">
                <h3>Sneakers</h3>
                <p>
                  Explore Our Shoes Now &emsp;<a
                    href="./products.php"
                    class="button"
                    >Explore</a
                  >
                </p>
              </div>
            </div>
            <div class="product">
              <figure class="img-box">
                <img
                  src="../../../_images/products/tshirt.jpg"
                  alt="product_4"
                  class="img"
                />
              </figure>
              <div class="content">
                <h3>T-Shirts</h3>
                <p>
                  Explore Our Shirts Now &emsp;<a
                    href="./products.php"
                    class="button"
                    >Explore</a
                  >
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Products Preview -->

      <!-- Contact Me -->
      <section class="contact" id="contact">
        <div class="container">
          <h2>contact</h2>
          <form action="">
            <div class="form-grid">
              <input
                type="text"
                name="name"
                id="name"
                class="form-element"
                placeholder="Enter your name"
              />
              <input
                type="email"
                name="email"
                id="email"
                class="form-element"
                placeholder="Enter your email"
              />
              <textarea
                name="message"
                id="message"
                class="form-area"
                placeholder="Message to deliver"
              ></textarea>
            </div>
            <div class="right-align">
              <input
                type="submit"
                class="button"
                value="Send message"
                name="send"
              />
            </div>
          </form>
        </div>
      </section>
      <!-- /Contact Me -->

      <!-- Php to handle the Contact -->
      <!-- The following work could be applied to send an email 
        to a free email server but not the widely known platfomrs 
        The implementation needed additional work not specified for 
        the current project's requirements -->
      <?php
          if(isset($_POST['send'])){
            $name = $_POST['name'];
            $emailFrom = $_POST['email'];
            $subject = "ESTORE"; 
            $message = $_POST['message'];

            $emailTo = "psklavos1@tuc.gr";
            $headers = "From: " . $emailFrom;
            $txt = "You have receiver a new email from " . $name . ".\n\n" . $message;

            mail($emailTo, $subject, $txt, $headers);
            header("Location: welcome.php?mailsent");
          }
        ?>
      <!-- /Php to handle the Contact -->
    </main>
    <!-- /Main -->

    <!-- Footer -->
    <footer>
      <?php include_once './footer.html'; ?>
    </footer>
    <!-- /Footer -->
  </body>
</html>
