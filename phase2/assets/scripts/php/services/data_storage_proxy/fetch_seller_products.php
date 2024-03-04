<?php
session_start();
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$userid = $_SESSION['id'];
$username = $_SESSION['username'];

$curl = curl_init("http://".$proxy.":".$port."/api/product/get_seller_products.php?username=".$username);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response, true);

$res = "";
if ($result &&  !array_key_exists('message',$result) && count($result) > 0) {
    foreach($result as $key) {
        foreach($key as $row){
            $product_id = (string)$row['id'];
            $res .= '<tr id = "'. $product_id . '">
                    <td>' . 
                        '<img src="../../../_images/products/'. $product_id .'.jpg" alt="product">' .
                    '</td>
                    <td>' .
                        $row['name'] .
                    '</td>
                    <td>' .
                        $row['productcode'] .
                    '</td>
                    <td class="euro">' .
                        $row['price'] .
                    '</td>
                    <td>' .
                        $row['dateofwithdrawal'] .
                    '</td>
                    <td>' .
                        $row['category'] .
                    '</td>
                    <td>' .
                        $row['available'] .
                    '</td>
                    <td>';
            $res .= "<div
            id = \"$product_id\">";

            $res .= "<a id =\"$product_id\" value=\"edit\" class = \"edit-btn\" title=\"Edit\" onclick=\"change_btns(this)\"><i class=\"fas fa-edit\" id = \"edit-svg\"></i></a>
            <a id =\"$product_id\" value=\"save\" class = \"save-btn invisible\" title=\"Save\" onclick=\"change_btns(this)\"><i class=\"fas fa-save\" id = \"save-edit-svg\"></i></a>  
            <a id =\"$product_id\" value=\"reject\" class = \"reject-btn invisible\" title=\"Cancel\" onclick=\"change_btns(this)\"><i class=\"fas fa-times\" id = \"cancel-edit-svg\"></i></a>
            <a value=\"delete\" class = \"delete-btn\" title=\"Remove\" id=\"".$product_id."\"><i class=\"fas fa-trash-alt\"></i></a>";

            $res .= '</div></td></tr>';
        }
    }
}else{
    $res = "<h1 style= \"font-weight: 700; text-align: left\>No Products Available!</h1>";
}

echo json_encode(array("html" => $res));
 
?>