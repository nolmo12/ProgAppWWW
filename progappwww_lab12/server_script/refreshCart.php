<table>
                <thead>
                <tr>
                    <td>Id Produktu</td>
                    <td>Nazwa</td>
                    <td>Cena</td>
                    <td>Ilość</td>
                </tr>
                </thead>
<?php
require_once 'functions.php';
require_once 'Cart.php';
session_start();
                $cartItems = $_SESSION['cart']->getItems();
                foreach ($cartItems as $cartItem) {
                    echo '<tr><td>' . $cartItem['product']->getId() . '</td><td>' . $cartItem['product']->getTitle() . '</td><td>'.$cartItem['product']->getNettoPrice().'</td><td> ' . $cartItem['quantity'] . '</td></tr>';
                }
?>
<tr><td></td><td></td><td>Total: <?php
    echo $_SESSION['cart']->getTotal();
?></td><td></td></tr>
</table>