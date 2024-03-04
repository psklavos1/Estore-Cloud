<?php
// This file contains helper functions that process the backend operation of the Website

// Check Functions

// Check if user is logged in
function check_login($con)
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['username'];
        // If logged Fetch the user's data
        $query = "SELECT * FROM users WHERE USERNAME = '$username'";
        $res = mysqli_query($con, $query);

        if ($res && mysqli_num_rows($res) > 0) {
            $user_data = mysqli_fetch_assoc($res);
            return $user_data;
        }
    } else {
        // If not logged
        // redirect to login
        header('Location: ../error/unlogged_error.php');
        die();
    }
}

// Function that checks if a given user is cataloged as a seller
function check_seller($con, $user_id)
{
    $query = "SELECT * FROM users WHERE ID = $user_id AND ROLE =\"Seller\"";
    $res = mysqli_query($con, $query);

    // If there is a seller in database with the given id we are fine
    if ($res && mysqli_num_rows($res) > 0) {
        return;
    } else {
    // The user is not a seller so redirect to access error.
        header('Location: ../error/unauthorized_seller.php');
        die();
    }
}

// Function that checks if a given user is cataloged as an admin
function check_admin($con, $user_id)
{
    $query = "SELECT * FROM users WHERE ID = $user_id AND ROLE =\"Admin\"";
    $res = mysqli_query($con, $query);
    
    // If there is a admin in database with the given id we are fine
    if ($res && mysqli_num_rows($res) > 0) {
        return;
    } else {
    // If there is a admin in database with the given id we are fine
        header('Location: ../error/unauthorized_admin.php');
        die();
    }
}

// Check if a given product is in the user's cart
function check_in_cart($con, $user_id, $product_id)
{
    $query = "SELECT * FROM CARTS WHERE USERID = '$user_id' AND PRODUCTID = '$product_id' limit 1";
    $res = mysqli_query($con, $query);

    // If exists an instance of the given product in this user's cart return true else false
    if ($res && mysqli_num_rows($res) > 0) {
        return true;
    } else {
        return false;
    }
}

// Check if a user is confirmed 
function check_if_confirmed($con, $user_id)
{
    $query = "SELECT * FROM users WHERE ID = '$user_id' AND CONFIRMED = 1";
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        return true;
    }
    return false;
}

// This function returns a user's name given his id in the format that is inserted
// in the database in the products(Name Surname)
function seller_name($con, $id)
{
    $query = "SELECT * FROM users WHERE ID = '$id'";
    $res = mysqli_query($con, $query);
    
    if ($res && mysqli_num_rows($res) > 0) {
        $array = $res->fetch_array();
        return  $array['NAME'] . ' ' . $array['SURNAME']; 
    }
    return -1;
}

// Print functions

// Products page

// This function is used to present if a product is in the user's cart.
// In case it is the cart symbol over a product is becoming purple to 
// notify the user that the product is already inside.
function show_in_cart($con, $user_id,$product_id)
{
    // $concert_id = find_concert_id($con, $concert_title, $concert_date);
    $in_cart = false;
    $in_cart = check_in_cart($con, $user_id, $product_id);
    
    echo 
        '<div class="cart">' . 
        '<a href="#" id ="a-' . $product_id . '">'
    ;

    echo $in_cart ?
        '<i class = "fa-solid fa-cart-shopping" style = "color:purple;"></i></a></div>'
        :
        '<i class = "fa-solid fa-cart-shopping"></i></a></div>';
}

// This function is used as a helper to print all the products that are retunrned as a
// result of query.
function print_products_helper($con,$user_id,$res)
{
    while ($row = mysqli_fetch_assoc($res)) {
        echo 
        '<div class="box">';
        $image_path = '../../../_images/products/' . $row['ID']. '.jpg' ;
        $default_path ='../../../_images/products/no-img.png' ;
        // In this implementation the image of a product has always a name: product_id.jpg
        // If a such file does not exist in the product images folder then show the default
        // "No image" image.
        echo file_exists($image_path) ? 
            '<img src = "' . $image_path .'" alt="product"></img>' :
            '<img src = "' . $default_path . '" alt="product"></img>' ;
        echo 
            '<div class="content">
                <h4>'. $row['NAME'] .'</h4>
                <p>Product Code: <span>' . $row['PRODUCTCODE'] . '</span></p>'.
                '<p class = "euro">Price: <span>' . $row['PRICE'] . '</span></p>'.
                '<p>Date Of Withdrawal: <span>' . $row['DATEOFWITHDRAWAL'] . '</span></p>'.
                '<p>Category: <span>' . $row['CATEGORY'] . '</span></p>' . 
                '<p>SELLER: <span>' . $row['SELLERNAME'] . '</span></p>';
        show_in_cart($con,$user_id,$row['ID']);
        echo  
                '<button class="add-cart" id = "'. $row['ID'] .'">Add To Cart</button>
            </div>
        </div>';
    }

}

// With this function all the products are printed.
// (the user id argument is to check if a product is inside a user's cart)
function print_all_products($con,$user_id)
{
    $query = 'SELECT * FROM PRODUCTS';
    $res = mysqli_query($con, $query);
    if ($res && mysqli_num_rows($res) > 0) {
       print_products_helper($con,$user_id,$res);
    }
    else {
        echo "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
    }
}

// With this function the resulted products of search by .... are printed.
// In this category we have the search by:
// name, productocode, category, sellername
function print_products_by_equal($con,$user_id, $search, $by)
{
    $query = "SELECT * FROM PRODUCTS where $by = '$search'";
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
       print_products_helper($con,$user_id,$res);
    }
    else {
        echo "<h1 style= \"font-weight: 700; text-align: left\">NO RESULTS FOUND<br />Description: " . $search . "<br />Category: " . $by . "</h1>";
    }
}

// With this function the resulted products of search by: less than given value, are printed.
// In this category we have the search by:
// max price, max date of withdrawal
function print_products_less_than($con,$user_id, $search, $by)
{   
    if($by == "DATEOFWITHDRAWAL"){
        $query = "SELECT * FROM products WHERE DATE(DATEOFWITHDRAWAL) <= '$search' ";
    }
    else{
        $query = "SELECT * FROM PRODUCTS where $by <= '$search'";
    }
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
       print_products_helper($con,$user_id,$res);
    }
    else {
        echo "<h1 style= \"font-weight: 700; text-align: left\">NO RESULTS FOUND<br />Description: " . $search . "<br />Category: " . $by . "</h1>";
    }
}
   
// Carts

// This function is used as a helper to print all the products in cart that are retunrned as a
// result of query. Multiple values are printed including the product name the datetime of last insertion
// the product's price, the quantity of inserted instances of the product and the final subtotal of them.
function print_carts_helper($con,$user_id,$res){
    $has_data = -1;
    // $row_no =1;
    $carts_sum = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        $has_data =0;
        $product_name = $row['NAME'];
        $product_id = $row['ID'];
        $last_insertion_date = last_insertion_date($con,$user_id,$product_id);
        $price = $row['PRICE'];
        $quantity = product_cart_apperances($con,$user_id,$product_id);
        $subtotal = $quantity*$price;
        
        echo '<tr id= "'.$product_id.'">
                <td>
                    <button class="remove-btn" ><i class="fa-regular fa-trash-can fa-xl"></i></button>
                </td>
                <td>
                    <img src="../../../_images/products/'. $product_id .'.jpg" alt="product">
                </td>
                <td>'. $product_name .'</td>
                <td>'. $last_insertion_date .'</td>
                <td class="euro price">'.$price.'</td>
                <td class>
                    <div class = "wrapper">
                        <button class="item decrement-btn">-</button>
                        <span class="item number">'.$quantity.'</span>
                        <button class="item increment-btn">+</button>
                    <//div>
                </td>
                <td class="euro subtotal-td">'.$subtotal.'</td>
            </tr>';
        
            $carts_sum += $subtotal;
    }   
    if($has_data == -1){
        echo "<h1 style = \"text-align: center;  font-size: 45px;\">No Items Found In Cart</h1>";
    }
    return $carts_sum;
}

// This function uses the above helper to print all products inside a user's cart if something exists.
// Else it prints that the cart is empty. It also returns the calculated subtotal to reduce recurring calculations
function print_carts($con,$user_id){
    $query = "SELECT * FROM products WHERE ID IN
                    (SELECT DISTINCT(PRODUCTID) FROM carts WHERE USERID ='$user_id')";
    $res = mysqli_query($con, $query);
    $carts_subtotal = 0;
    // If cart not empty then
    if ($res && mysqli_num_rows($res) > 0) {
        $carts_subtotal = print_carts_helper($con,$user_id,$res,0);
    }
    else{
        $carts_subtotal = print_carts_helper($con,$user_id,$res,-1);
    }
    return $carts_subtotal;
}

// This function prints the Subtotal section as it forms with the given shipping expenses 
// and coupon discount on the starting cart subtotal
function print_carts_checkout($carts_subtotal, $discount, $shipping){
    echo    
        '<tr>
            <td>Cart Subtotal</td>
            <td class = "euro" id = "cart-subtotal">'.$carts_subtotal.'</td>
        </tr>
        <tr>
            <td>Coupon Discount</td>
            <td class = "euro" id = "cart-discount">'.$discount.'</td>
        </tr>
        <tr>
            <td>Shipping</td>
            <td class = "euro" id = "cart-shipping">'.$shipping.'</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td class = "euro bold" id = "cart-total">';
    $total = $carts_subtotal + $shipping - $discount;    
    echo ($total >=0) ? $total : 0 .
            '</td>
        </tr>';
}

// Seller

// This function prints all the products of a given seller
function print_seller_products($con, $user_id)
{
    $query = "SELECT * FROM `products` where SELLERID = '$user_id'";
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        // If found
        while ($row = mysqli_fetch_assoc($res)) {
            $product_id = $row['ID'];
            echo '<tr id = " '. $product_id . '">
                    <td>' . 
                        '<img src="../../../_images/products/'. $product_id .'.jpg" alt="product">' .
                    '</td>
                    <td>' .
                        $row['NAME'] .
                    '</td>
                    <td>' .
                        $row['PRODUCTCODE'] .
                    '</td>
                    <td class="euro">' .
                        $row['PRICE'] .
                    '</td>
                    <td>' .
                        $row['DATEOFWITHDRAWAL'] .
                    '</td>
                    <td>' .
                        $row['CATEGORY'] .
                    '</td>
                    <td>';

            $product_id = $row['ID'];
            echo "<div
            id = $product_id>";

            echo "<a id =$product_id value=\"edit\" class = \"edit-btn\" title=\"Edit\" onclick=\"change_btns(this)\"><i class=\"fas fa-edit\" id = \"edit-svg\"></i></a>
            <a id =$product_id value=\"save\" class = \"save-btn invisible\" title=\"Save\" onclick=\"change_btns(this)\"><i class=\"fas fa-save\" id = \"save-edit-svg\"></i></a>  
            <a id =$product_id value=\"reject\" class = \"reject-btn invisible\" title=\"Cancel\" onclick=\"change_btns(this)\"><i class=\"fas fa-times\" id = \"cancel-edit-svg\"></i></a>
            <a value=\"delete\" class = \"delete-btn\" title=\"Remove\" ><i class=\"fas fa-trash-alt\"></i></a>";

            echo '</div></td></tr>';
        }
    }
}

// Admin

// This function prints all the users that are cataloged. Both those that are confirmed and those who are
// not. Foe each of the above, different actions are given to the admin
function print_users($con)
{
    $query = 'SELECT * FROM `users`';
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        $id = 0;
        // If found
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr><td class = \"invisible\">" .
                $row['ID'] .
                '</td><td>' .
                $row['NAME'] .
                '</td><td>' .
                $row['SURNAME'] .
                '</td><td>' .
                $row['USERNAME'] .
                '</td><td>' .
                $row['EMAIL'] .
                '</td><td>' .
                ucfirst(strtolower($row['ROLE'])).
                '</td><td>';

            $user_id = $row['ID'];
            $is_confirmed = check_if_confirmed($con, $user_id);

            echo $is_confirmed ? 
            "<div id = $user_id class=\"confirmed\">" :
            "<div id = $user_id>";

            echo $is_confirmed
                ? "<a id = $user_id value=\"edit\" class = \"edit-btn\" title=\"Edit\" onclick=\"change_btns(this)\"><i class=\"fas fa-edit\" id = \"edit-svg\"></i></a>
                <a id = $user_id value=\"save\" class = \"save-btn invisible\" title=\"Save\" onclick=\"change_btns(this)\"><i class=\"fas fa-save\" id = \"save-edit-svg\"></i></a>  
                <a id = $user_id value=\"reject\" class = \"reject-btn-edit invisible\" title=\"Cancel\" onclick=\"change_btns(this)\"><i class=\"fas fa-times\" id = \"cancel-edit-svg\"></i></a>
                <a value=\"delete\" class = \"delete-btn\" title=\"Remove\"><i class=\"fas fa-user-slash\"></i></a>"
                : "<a value=\"approve\" class = \"approve-btn\" title=\"Confirm\"><i class=\"fas fa-check\"></i></a>
                  <a value=\"reject\" class = \"reject-btn\" title = \"Reject\"><i class=\"fas fa-times\"></i></a>";
            echo '</div>';
            echo '</td></tr>';
            $id = $id + 1;
        }
    }
}

// Calculation functions

// This function is used to determine the last date that a product was inserted into a cart
// This is imporatant as a product can be included more than once in a user's cart. 
// we need to keep a FIFO format for the products in the cart
function last_insertion_date($con,$user_id,$product_id){
    $query = "SELECT DATEOFINSERTION FROM carts WHERE PRODUCTID = '$product_id' AND
        USERID = '$user_id' ORDER BY DATEOFINSERTION DESC limit 1";
    $res = mysqli_query($con, $query);
    
    if ($res && mysqli_num_rows($res) > 0) {
        return $res->fetch_array()['DATEOFINSERTION'];
    }
    else return new DateTime("0000-00-00 00:00:00");
}

// Caclculates the quantity of a product counting the appearances of a given product in a user's cart
function product_cart_apperances($con,$user_id,$product_id){
    $query = "SELECT count(*) AS COUNT FROM carts Where USERID = '$user_id' AND 
                                            PRODUCTID = '$product_id'"; 
    $res = mysqli_query($con, $query);
    if ($res && mysqli_num_rows($res) > 0) {
        return $res->fetch_array()['COUNT'];
    }
    else return 0;
}

?>
