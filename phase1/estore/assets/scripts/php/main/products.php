<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Products</title>
      <!-- CSS -->
      <link rel="stylesheet" href="../../../css/products_style.css" />
      <!-- JQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <!-- Icons Fontawesome -->
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    </head>

    <body>
      <!-- Navbar -->
      <header>
        <?php include './navbar.html'; ?>
      </header>
      <!-- /Navbar -->

      <!-- Main -->
      <main>
        <section class="products" id="products">
          <div class="search-bar">
            <div class="input-box">
              <form method = "POST">
                <div id="select">
                  <p id="selectText">SHOW ALL</p>
                  <input name="searchBy" id = "searchBy" type="hidden" value="SHOW ALL" />
                  <ul id="list">
                    <li class="options">SHOW ALL</li>
                    <li class="options">NAME</li>
                    <li class="options">PRODUCT CODE</li>
                    <li class="options">MAX PRICE</li>
                    <li class="options">MAX DATE OF WITHDRAWAL</li>
                    <li class="options">CATEGORY</li>
                    <li class="options">SELLER NAME</li>
                  </ul>
                </div>
                
                <input name = "search" type="text" placeholder="Search here..." id ="searchText"/>
                <button class="button" id = "search-btn" type="submit" name ="submit">Search</button>
              </form>
            </div>
            <a href="./cart.php" class="cart-icon"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
          </div>
          <div class="container">
            <?php
            if(!isset($_POST['submit'])){
              print_all_products($con,$user_data['ID']); 
            }
            else{
              $searchBy = $_POST['searchBy']; 
              $user_id = $user_data['ID'];
              $search = $_POST['search'];
              if($searchBy == 'SHOW ALL'){
                print_all_products($con,$user_id);
              }
              else if($searchBy == 'NAME'){
                print_products_by_equal($con,$user_id,$search ,"NAME");
              }
              else if($searchBy == 'PRODUCT CODE'){
                print_products_by_equal($con,$user_id, $search,"PRODUCTCODE");
              }
              else if($searchBy == 'MAX PRICE'){
                print_products_less_than($con,$user_id, $search, "PRICE");
              }
              else if($searchBy == 'CATEGORY'){
                print_products_by_equal($con,$user_id, $search,"CATEGORY");
              }
              else if($searchBy == "SELLER NAME"){
                print_products_by_equal($con,$user_id, $search,"SELLERNAME");
              }
              // Date Of Withdrawal
              else if($searchBy == "MAX DATE OF WITHDRAWAL"){
                print_products_less_than($con,$user_id, $search, "DATEOFWITHDRAWAL");
              }

            }
            ?>
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
      <script src="../../javascript/products.js"></script>
      <!-- /Scripts -->
    </body>
  </html>
</html>
