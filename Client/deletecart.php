<?php
$index = $_GET["index"];
session_start();
$cart = $_SESSION['cart'];
array_splice($cart, $index, 1);
$_SESSION['cart'] =  $cart;
header("Location:listcart.php");
