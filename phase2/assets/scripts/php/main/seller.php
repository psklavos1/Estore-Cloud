<?php
session_start();
include '../helper_scripts/functions.php';
$user_data = $_SESSION;
check_login($user_data);
check_seller($user_data['role']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller</title>
    <!-- Logo -->
    <link rel="icon" href="../../../_images/icon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/management_style.css" />
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
  <!-- /Navbar -->

  <!-- Main -->
  <main>
    <section class="banner">
      <div class="container">
        <div class="title"><h1>My Products:</h1></div>
        <table class="table-content">
          <thead>
            <tr>
              <th class="invisible">id</th>
              <th>IMAGE</th>
              <th>NAME</th>
              <th>PRODUCT CODE</th>
              <th>PRICE</th>
              <th>WITHDRAWAL</th>
              <th>CATEGORY</th>
              <th>AVAIL</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id = "my-product-data">
            <!-- Javascript Fill -->
          </tbody>
        </table>
        <button class="add-btn" title="Add New">
          <i class="fas fa-plus fa-lg"></i>
        </button>
      </div>
  
      <div class="modal-bg" id="mod-1">
        <div class="modal" id="mod-1">
          <h2>Add New Product</h2>
          <form action="#" method="POST" id="add-form">
            <div class="textbox">
              <label for="name">Name*</label>
              <input
                type="text"
                name="name"
                placeholder="Enter Product name"
                id="name"
                required
              />
              <p class="error" id="name_error_msg"></p>
            </div>
            <div class="textbox">
              <label for="product_code">Product Code*</label>
              <input
                type="text"
                name="product_code"
                placeholder="Enter the Product Code"
                id="product_code"
                required
              />
              <p class="error" id="product_code_error_msg"></p>
            </div>
            <div class="textbox">
              <label for="price">Price*</label>
              <input
                type="text"
                name="price"
                placeholder="Enter the Price"
                id="price"
                required
              />
              <p class="error" id="price_error_msg"></p>
            </div>
            <div class="textbox">
              <label for="date_of_withdrawal">Date Of Withderawal*</label>
              <input
                type="text"
                name="date_of_withdrawal"
                placeholder="Enter date of withdrawal"
                id="date_of_withdrawal"
                required
              />
              <p class="error" id="date_of_withdrawal_error_msg"></p>
            </div>
            <div class="textbox">
              <label for="category">Category*</label>
              <input
                type="text"
                name="category"
                placeholder="Enter category"
                id="category"
                required
              />
              <p class="error" id="category_error_msg"></p>
            </div>
            <div class="textbox">
              <label for="category">Available*</label>
              <input
                type="text"
                name="available"
                placeholder="Enter available pieces"
                id="available"
                required
              />
              <p class="error" id="available_error_msg"></p>
            </div>
  
            <div class="btns">
              <br />
              <button id="revert-btn">Revert</button>
              <button type="submit" id="submit-btn">Add</button>
            </div>
            <span class="modal-close" id="mod-cl-1"
              ><i class="fas fa-times"></i
            ></span>
          </form>
        </div>
      </div>
    </section>
  </main>
  <!-- /Main -->
        
  <!-- Footer -->
  <footer>
    <?php include_once './footer.html'; ?>
  </footer>
  <!-- /Footer -->
  <!-- Javascript -->
  <script src="../../javascript/seller.js"></script>
  <!-- /Javascript -->
  </body>
</html>
 