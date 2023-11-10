<?php
include "Database.php";
include "Vehicle.php";
$db = Database::getInstance();
if($db->connect_error)
{
    echo "Błąd w połączeniu z bazą danych: " . $db->connect_error;
}

function getFunFact()
{
    $db = Database::getInstance();
    $result = $db->query("SELECT COUNT(`id`) as `count` FROM `ciekawostki`");
    $data = $result->fetch_assoc();
    $max = intval($data['count']);
    $result->free_result();

    $random = rand(1, $max);

    $result = $db->query("SELECT `tekst` FROM `ciekawostki` WHERE `id` = $random");
    $data = $result->fetch_assoc();

    echo $data['tekst']; 
}

function placeUnderScoreBeforeString(string &$str)
{
    $tempStr = "_";
    $tempStr .= $str;
    $str = $tempStr;
}

function printGallery(array $vehicles)
{
    foreach($vehicles as $vehicle)
    {
        echo "<div class='image' onclick='getInfo(".$vehicle->getId().")'>";
        echo $vehicle->getImage();
        echo "</div>";
    }
}
?>