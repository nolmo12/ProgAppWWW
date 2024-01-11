<?php
require_once 'functions.php';
require_once 'Cart.php';
session_start();

if (isset($_GET['val'])) {
    $id = $_GET['id'];
    $quantity = $_GET['val'];

    $_SESSION['cart']->updateQuantity($id, $quantity);
    echo 'xd';
}
?>
