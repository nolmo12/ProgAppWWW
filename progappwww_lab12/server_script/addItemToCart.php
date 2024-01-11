<?php
require_once 'functions.php';
require_once 'Cart.php';
session_start();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productToAdd = new Product($productId);
    
    if ($productToAdd->getId() && $productToAdd->getAvailability() != 0) {
        $_SESSION['cart']->addItem($productToAdd, 1);
    }
}
?>
