<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

    $result = $db->query("SELECT `tekst` FROM `ciekawostki` WHERE `id` = $random LIMIT 1");
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

function showPage($id = 2)
{
    $db = Database::getInstance();
    if (!is_int($id)) {
        throw new InvalidArgumentException('Invalid argument type for $id. Must be of type int.');
    }
    
    $query = "SELECT * FROM `page_list` WHERE id = ? LIMIT 1";

    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $pageData = $result->fetch_assoc();

    if (!$pageData) {
        throw new Exception("Page not found");
    }
    return $pageData['page_content'];
}
?>