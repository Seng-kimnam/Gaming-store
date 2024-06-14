<?php
$productid = $_GET["productid"];
$productname = $_GET["productname"];
$price = $_GET["price"];
$qty = 1;
$cart = [];
$isfound = false;
session_start();
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    for ($r = 0; $r < count($cart); $r++) {
        if ($cart[$r][0] == $productid) {
            $isfound = true;
        }
    }
}
if ($isfound == false) {
    array_push($cart, [$productid, $productname, $price, $qty]);
    $_SESSION['cart'] =  $cart;
}
header("Location:cart.php");
