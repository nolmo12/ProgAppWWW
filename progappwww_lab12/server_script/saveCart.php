<?php
require_once 'functions.php';
require_once 'Cart.php';
session_start();

$_SESSION['cart']->save();

?>
