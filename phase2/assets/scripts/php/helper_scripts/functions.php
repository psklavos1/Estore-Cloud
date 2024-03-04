<?php
// This file contains helper functions that process the backend operation of the Website
include 'token_valid.php';
// Check Functions

// Check if user is logged in
function check_login($data)
{
    if (isset($data['role']) && isset($data['id']) && isset($data['email']) 
        && isset($data['username']) && isset($data['token']) && tokenValid($data['xtoken'])) 
    {
        return;
    } else {
        // If not logged
        // redirect to login
        header('Location: ../error/unlogged_error.php');
        die();
    }
}

// Function that checks if a given user is cataloged as a seller
function check_seller($role)
{
    if ($role == "Seller") {
        return;
    } else {
        // The user is not a seller so redirect to access error.
        header('Location: ../error/unauthorized_seller.php');
        die();
    }
}

// Function that checks if a given user is cataloged as an admin
function check_admin($role)
{
    if ($role == "Admin") {
        return;
    } else {
        header('Location: ../error/unauthorized_admin.php');
        die();
    }
}

// Mongo Done
// Check if a given product is in the user's cart
function check_in_cart($con, $user_id, $product_id)
{
    // New
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->carts;
    assert($collection);
    $filter = [
        'userid' => intval($user_id),
        'productid' =>new MongoDB\BSON\ObjectId($product_id)
    ];
    $cursor = $collection->findOne($filter);
    // var_dump($cursor);
    if($cursor){
        return true;
    }
    return false;
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
// Mongo Done
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
// Mongo Done
function print_products_helper($dbClient,$user_id,$cursor)
{
    foreach ($cursor as $row) {
        echo 
        '<div class="box">';
        $image_path = '../../../_images/products/' . $row->_id. '.jpg' ;
        $default_path ='../../../_images/products/no-img.png' ;
        // In this implementation the image of a product has always a name: product_id.jpg
        // If a such file does not exist in the product images folder then show the default
        // "No image" image.
        echo file_exists($image_path) ? 
            '<img src = "' . $image_path .'" alt="product"></img>' :
            '<img src = "' . $default_path . '" alt="product"></img>' ;
        echo 
            '<div class="content">
                <h4>'. $row->name .'</h4>
                <p>Product Code: <span>' . $row->productcode . '</span></p>'.
                '<p class = "euro">Price: <span>' . $row->price . '</span></p>'.
                '<p>Date Of Withdrawal: <span>' . $row->dateofwithdrawal . '</span></p>'.
                '<p>Category: <span>' . $row->category . '</span></p>' . 
                '<p>Seller: <span>' . $row->sellername . '</span></p>';
                // To do
                show_in_cart($dbClient,$user_id,$row->_id);
        echo  
                '<button class="add-cart" id = "'. $row->_id .'">Add To Cart</button>
            </div>
        </div>';
    }
}

// With this function all the products are printed.
// (the user id argument is to check if a product is inside a user's cart)
// Mongo Done
function print_all_products($con,$user_id)
{
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->products;
    assert($collection);
    $cursor = $collection->find();

    if ($cursor) {
       print_products_helper($con,$user_id,$cursor);
       return;
    }
    echo "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
}

// With this function the resulted products of search by .... are printed.
// In this category we have the search by:
// name, productocode, category, sellername.
// The search is done documents starting with substring given in search
// Mongo Done
function print_search($con,$user_id, $search, $by){
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->products;
    assert($collection);

    $regex = new \MongoDB\BSON\Regex('^'.$search , 'i');
    $filter = [$by=>$regex];
    $cursor = $collection->find($filter);
    if ($cursor) {
        print_products_helper($con,$user_id,$cursor);
        return;
    }
    echo "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
}



// With this function the resulted products of search by: less than given value, are printed.
// In this category we have the search by:
// max price, max date of withdrawal
// Mongo DONE
function print_search_less_than($con,$user_id, $search, $by)
{   
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->products;
    assert($collection);
    $filter = [$by => ['$lte'=>$search]];
    $cursor = $collection->find($filter);
    // echo "Search by: " . $by . " \nand search content: " . $search; 
    if ($cursor) {
        // echo "Here";
        print_products_helper($con,$user_id,$cursor);
        return;
    }
    echo "<h1 style= \"font-weight: 700; text-align: left\">No Products Available!</h1>";
}
   
// Carts

// This function is used as a helper to print all the products in cart that are retunrned as a
// result of query. Multiple values are printed including the product name the datetime of last insertion
// the product's price, the quantity of inserted instances of the product and the final subtotal of them.
// Mongo DONE
function print_carts_helper($con,$user_id,$cursor){
    // New
    $has_data = false;
    $carts_sum = 0;

    foreach ($cursor as $row) {
        $has_data = true;
        $product_name = $row->name;
        $product_id = $row->_id;
        $cur = last_insertion_date($con,$user_id,$product_id);
        // one document only
        foreach ($cur as $doc){
            $last_insertion_date = $doc->dateofinsertion;
        }
        $price = $row->price;
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
    if(!$has_data){
        echo "<h1 style = \"text-align: center;  font-size: 45px;\">No Items Found In Cart</h1>";
    }
    return $carts_sum;
}

// This function uses the above helper to print all products inside a user's cart if something exists.
// Else it prints that the cart is empty. It also returns the calculated subtotal to reduce recurring calculations
// Mongo DONE
function print_carts($con,$user_id){
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
   
    $temp = $db->carts->distinct( "productid", ["userid" => intval($user_id)] );
    $filter = ['_id' => ['$in' => $temp]];
    $cursor = $db->products->find($filter);

    if ($cursor) {
        // echo "Here";
        $carts_subtotal = print_carts_helper($con,$user_id,$cursor);
        return $carts_subtotal;
    }
    echo "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
    return 0;
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
// Mongo
function print_seller_products($con, $user_data)
{
   
    $db = $con->estore;
    $collection = $db->products;
    assert($collection);

    $filter = ['sellername' => $user_data['username']];
    $cursor = $collection->find($filter);

    if ($cursor) {
        foreach($cursor as $doc){
            $product_id = (string)$doc->_id;
            echo '<tr id = " '. $product_id . '">
                    <td>' . 
                        '<img src="../../../_images/products/'. $product_id .'.jpg" alt="product">' .
                    '</td>
                    <td>' .
                        $doc->name .
                    '</td>
                    <td>' .
                        $doc->productcode .
                    '</td>
                    <td class="euro">' .
                        $doc->price .
                    '</td>
                    <td>' .
                        $doc->dateofwithdrawal .
                    '</td>
                    <td>' .
                        $doc->category .
                    '</td>
                    <td>';
            echo "<div
            id = $product_id>";

            echo "<a id =$product_id value=\"edit\" class = \"edit-btn\" title=\"Edit\" onclick=\"change_btns(this)\"><i class=\"fas fa-edit\" id = \"edit-svg\"></i></a>
            <a id =$product_id value=\"save\" class = \"save-btn invisible\" title=\"Save\" onclick=\"change_btns(this)\"><i class=\"fas fa-save\" id = \"save-edit-svg\"></i></a>  
            <a id =$product_id value=\"reject\" class = \"reject-btn invisible\" title=\"Cancel\" onclick=\"change_btns(this)\"><i class=\"fas fa-times\" id = \"cancel-edit-svg\"></i></a>
            <a value=\"delete\" class = \"delete-btn\" title=\"Remove\" ><i class=\"fas fa-trash-alt\"></i></a>";

            echo '</div></td></tr>';
        }
        return;
    }
    echo "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
}

// Admin

// This function prints all the users that are cataloged. Both those that are confirmed and those who are
// not. Foe each of the above, different actions are given to the admin
function print_users($con)
{
    // ToDo With Request fetch the users

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
// Mongo
function last_insertion_date($con,$user_id,$product_id){
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->carts;
    assert($collection);
    $product_id = new MongoDB\BSON\ObjectId($product_id);

    $filter = ['productid' => $product_id, 'userid' => intval($user_id)];
    $options = ['sort' => ['dateofinsertion' => -1],
                'limit' => 1, 
                'projection' => ['dateofinsertion' => 1]];
    $cursor = $collection->find($filter,$options);
    
    // echo "Search by: " . $by . " \nand search content: " . $search; 
    if ($cursor) {
        return $cursor;
    }
    return "0000-00-00 00:00:00";
}

// Caclculates the quantity of a product counting the appearances of a given product in a user's cart
// Mongo
function product_cart_apperances($con,$user_id,$product_id){
    // NEW
    assert($con);
    $db = $con->estore;
    assert($db);
    $collection = $db->carts;
    assert($collection);
    $product_id = new MongoDB\BSON\ObjectId($product_id);

    $filter = ['userid'=>(int)$user_id, 'productid' => $product_id];
    $count = $collection->count($filter);
    if($count>0)
        return $count;
    return 0;
}

// function alert($output, $with_script_tags = true) {
//     $js_code = 'alert(' . json_encode($output, JSON_HEX_TAG) . ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     echo $js_code;
// }

// // function mylog($txt, $filename){
// //     $myfile = fopen($filename, "w") or die("Unable to open file!");
// //     fwrite($myfile, $txt);
// //     fclose($myfile);
// // }
// function myalert($message) {
//     // Display the alert box
//     echo "<script>alert('$message');</script>";
// }
// function myconsole($message) {
//     // Display the alert box
//     echo "<script>console.log('$message');</script>";
// }
?>
