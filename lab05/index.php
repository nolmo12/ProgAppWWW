<?php
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="Content-Language" content="pl"/>
        <meta name="Author" content="Paweł Bąk"/>
        <link rel="stylesheet" href="style/style.css" type="text/css"/>
        <title>Moje hobby to transport publiczny</title>
        <script src="script/jquery.js" defer></script>
        <script src="script/script.js" defer></script>
    </head>
    <body>
        <div id="container">
            <?php
                include "server_script/functions.php";
            ?>
            <div id="date">
                <div id="watch">dd</div>
            </div>
            <div id="main">
            <?php
                    $strona = '';
                    if(!isset($_GET['idp']) || $_GET['idp'] == 'main')
                        $strona = 'html/glowna.html';
                    switch($_GET['idp'])
                    {
                        case 'bus':
                            $strona = 'html/buses.html';
                            break;
                        case 'tram':
                            $strona = 'html/trams.html';
                            break;
                        case 'train':
                            $strona = 'html/trains.html';
                            break;
                        case 'subway':
                            $strona = 'html/subway.html';
                            break;   
                        case 'contact':
                            $strona = 'html/contact.html';
                            break;                                                                                 
                        case 'add_vehicle':
                            $strona = 'html/add_vehicle.html';
                            break;
                        case 'movies':
                            $strona = 'html/videos.html';
                            break;
                    }
                    if(!file_exists($strona))
                    {
                        header("Location: html/error.php/?err=404");
                        exit();
                    }
                    include $strona;
                    ?>
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