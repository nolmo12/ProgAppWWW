<?php
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    include "server_script/functions.php";
    require_once "server_script/Category.php";
    require_once "server_script/Product.php";
    require_once "server_script/Cart.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="Content-Language" content="pl"/>
        <meta name="Author" content="Paweł Bąk"/>
        <link rel="stylesheet" href="style/style.css" type="text/css"/>
        <title>
            <?php
                if(isset($_GET['idp']))
                {
                    try {
                        getTitle($_GET['idp']);
                    }
                    catch(Exception $e)
                    {
                        HEADER('Location: html/error.php');
                    }
                }
                else
                {
                    echo getTitle();
                }
            ?>
        </title>
        <script src="script/jquery.js" defer></script>
        <script src="script/script.js" defer></script>
    </head>
    <body onload="showTime()">
        <div id="container">
            <div id="date">
                <div id="watch">dd</div>
            </div>
            <div id="main">
            <nav>
                <ul>
                <li><a href="index.php?idp=1">Strona Główna</a></li>
                <li><a href="shop.php">Sklep</a></li>
                <li><a href="index.php?idp=2">Autobusy</a></li>
                <li><a href="index.php?idp=3">Tramwaje</a></li>
                <li><a href="index.php?idp=4">Pociągi</a></li>
                <li><a href="index.php?idp=5">Metro</a></li>
                <li><a href="index.php?idp=8">Filmy</a></li>
                <li><a href="index.php?idp=6">Kontakt</a></li>
                </ul>
            </nav>
            <main>
            <div id="cart-container">
                <span onclick='closeCart()' id="close-cart-mark">&#10006;</span>
                <div id = "cart" onclick="showCart()" >Koszyk
                <?php
                if(!isset($_SESSION['cart']))
                {
                    $Cart = new Cart();
                    $_SESSION['cart'] = $Cart;
                }
                ?>
                    <div class = "cart-menu" id="cart-menu">
                    </div>
                </div>
            </div>
            <h2>Kategorie: </h2>
                <?php
                
                $db = Database::getInstance();

                $categories = [];
                
                $query = "SELECT `id` FROM `categories` WHERE `parent` = 0";
                $result = $db->query($query);
                
                while($data = $result->fetch_assoc())
                {
                    array_push($categories, new Category($data['id']));
                }

                foreach($categories as $category)
                {
                    echo $category;
                }
                if(isset($_GET['cat']))
                {
                    $products = [];
                    $cat = new Category($_GET['cat']);
                    $catChildrenIds = [];

                    $cat->traverseCategory($catChildrenIds);
                    foreach($catChildrenIds as $childId)
                    {
                        $query = "SELECT `id` FROM `products` WHERE `category_id` = {$childId} AND `availability` != 0";
                        $result = $db->query($query);
    
                        while($data = $result->fetch_assoc())
                        {
                            array_push($products, new Product($data['id']));
                        }
                    }
                    
                    sort($products);

                    echo "<hr><h2>Produkty: </h2>";
                    foreach($products as $product)
                    {
                        $text = "<img src = \"imgs/shop/{$product->getPhoto()}\" width='128px' height = '128px'>";
                        echo $text.$product.'<br><button class = "button-add" onclick="addToCart('.$product->getId().')">Dodaj przedmiot do koszyka</button><br>';
                    }
                }

                ?>
            </main>
                <footer>
                    <?php
                        $nr_indeksu = '164343';
                        $nrGrupy = '3';
                        echo "Autor: Paweł Bąk $nr_indeksu grupa $nrGrupy";
                    ?>
                </footer>
            </div>
        </div>

    </body>
</html>