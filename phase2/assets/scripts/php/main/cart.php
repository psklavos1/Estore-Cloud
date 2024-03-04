<?php
session_start();
include '../helper_scripts/functions.php';
$user_data = $_SESSION;
check_login($user_data);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <!-- Logo -->
    <link rel="icon" href="../../../_images/icon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/cart_style.css" />
    <!-- Fontawesome Icons -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>

    <!-- Navbar -->
    <header>
      <?php include './navbar.html'; ?>
    </header>
    <!-- Navbar -->

    <!-- Main -->
    <main>
      <!-- Products In Cart -->
      <section id = "cart" class="cart">
        <div class="container">
          <table>
            <thead>
                <tr>
                  <td>Remove</td>
                  <td>Image</td>
                  <td>Product</td>
                  <td>Latest</td>
                  <td>Price</td>
                  <td>Quantity</td>
                  <td>Subtotal</td>
                </tr>
            </thead>
            <tbody id="cart-data">
              <!-- Javascript Fill -->
            </tbody>
          </table>
        </div>
      </section>
      <!-- /Products In Cart -->
      
      <!-- Coupon and Total Amounts -->
      <section class="checkout">
        <div class="container">
          <div class="coupon">
            <h3>Apply Coupon</h3>
            <div>
              <input type="text" placeholder="Enter Your Coupon">
              <button id="coupon-btn">Apply</button>
            </div>
          </div>
          <div class="subtotal">
            <h3>Cart Totals</h3>
            <table id ="checkout-data">
              <input type="hidden" id="subtotal" name="subtotal" value="0">
              <input type="hidden" id="shipping" name="shipping" value="2">
              <input type="hidden" id="discount" name="discount" value="0">
              <!-- Javascript Fill -->
            </table>
            <button id="checkout-btn">Checkout</button>
          </div>
        </div>
        </section>
      <!-- /Coupon and Total Amounts -->
    </main>
    <!-- /Main -->
          

    <!-- Footer -->
    <footer>
      <?php include_once './footer.html'; ?>
    </footer>
    <!-- /Footer -->


    <!-- Scripts -->
    <script src="../../javascript/cart.js"></script>
    <!-- /Scripts -->
  </body>
</html>


