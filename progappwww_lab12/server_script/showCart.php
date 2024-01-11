<table>
                <thead>
                <tr>
                    <td>Produkt</td>
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
                    echo '<tr>
                    <td><img src="imgs/shop/' .$cartItem['product']->getPhoto(). '" width="64px" height="64px"></td><td>' . $cartItem['product']->getTitle() . '</td><td>'.$cartItem['product']->getNettoPrice().'</td>
                    <td>  
                    <input id = "'.$cartItem['product']->getId().'" class = "quantity" 
                    type="text" value = "'. $cartItem['quantity'] . '" style="text-align:center" onchange="updateQuantity('.$cartItem['product']->getId().', this.value)">
                    </td>
                    <td><button class="button-remove" onclick="removeProduct('.$cartItem['product']->getId().')">🗑</button></td>
                    </tr>';
                }
?>
<tr><td></td><td></td><td>Total: <i><?php
    echo $_SESSION['cart']->getTotal();
?></i></td><td></td></tr>
</table>
<button onclick="saveCart()" class = "button-add right">Zapisz Koszyk</button>
<span id="warning"></span>