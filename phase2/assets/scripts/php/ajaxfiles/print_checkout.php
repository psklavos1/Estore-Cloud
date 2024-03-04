<?php
session_start();
$carts_subtotal = $_POST['carts_subtotal'];
$discount = $_POST['discount'];
$shipping = $_POST['shipping'];

$res = '';
$shipping = ($carts_subtotal >=0) ? $shipping : 0;
$res .=    
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
        <td class = "euro" id = "cart-shipping">'. $shipping.'</td>
    </tr>
    <tr>
        <td><strong>Total</strong></td>
        <td class = "euro bold" id = "cart-total">';
$total = $carts_subtotal + $shipping - $discount;    
$res .= ($total >=0) ? $total : 0 .
        '</td>
    </tr>';
echo json_encode(array('html'=> $res));
