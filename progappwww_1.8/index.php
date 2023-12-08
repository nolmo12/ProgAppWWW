<?php
    session_start();
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    include "server_script/functions.php";
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
                    echo getTitle($_GET['idp']);
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
                try {
                    if (isset($_GET["idp"])) {
                        $idp = intval($_GET["idp"]);
                        $content = showPage($idp);
                    } else {
                        $content = showPage();
                    }
                } catch (InvalidArgumentException $e) {
                    header("Location: html/error.php/?err=404");
                    // Handle the invalid argument type gracefully, e.g., redirect to an error page or display a user-friendly message.
                } catch (Exception $e) {
                    header("Location: html/error.php/?err=404");
                    // Handle other exceptions as needed.
                }
                    $substring = "<?php";
                    $substringEnd = "?>";
                    
                    // Find the index where the substring starts
                    $lastPos = 0;
                    $positions = [];
                    $phpCodeArray = [];
                    $phpCodeCommentArray = [];
                    
                    while(($lastPos = strpos($content, $substring, $lastPos)) !== false) {
                        $positions = $lastPos;
                        $lastPos = $lastPos + strlen($substring);
                        $lastPosEnd = strpos($content, $substringEnd, $lastPos);
                        $phpCode = substr($content, $lastPos, $lastPosEnd + 2);
                        $phpCodeComment = substr($content, $lastPos + 5, $lastPosEnd);;
                        
                        array_push($phpCodeArray, $phpCode);
                        array_push($phpCodeCommentArray, $phpCodeComment);
                    }
                    
                    $contentSplit = explode("<?php", $content);
                    if(count($contentSplit) === 1)
                    {
                        echo $content;
                    }
                    
                    for ($i = 0; $i < count($phpCodeArray); $i++) {
                        echo $contentSplit[$i];
                        eval($phpCodeArray[$i]);
                        $contentSplit = explode("?>", $content);
                        echo $contentSplit[1];
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