<?php
    session_start();
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    include "server_script/functions.php";
    require_once "server_script/Category.php";
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
                <li><a href="index.php?idp=2">Autobusy</a></li>
                <li><a href="index.php?idp=3">Tramwaje</a></li>
                <li><a href="index.php?idp=4">Pociągi</a></li>
                <li><a href="index.php?idp=5">Metro</a></li>
                <li><a href="index.php?idp=6">Kontakt</a></li>
                <li><a href="index.php?idp=7">Dodaj Pojazd</a></li>
                <li><a href="index.php?idp=8">Filmy</a></li>
                </ul>
            </nav>
            <main>
                <?php
                    echo new Category(1);
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