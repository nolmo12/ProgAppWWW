<?php
include 'functions.php';
$vehicle = new Vehicle(intval($_GET['id']));

echo "<h1>";
echo $vehicle->getName();
echo ", ";
echo $vehicle->getCity();
echo "</h1>";

echo "<span class='text-left' onclick='closeInfo()'>&#10006;</span>";
echo "<div class='center-img'>";
echo $vehicle->getImage();
echo "</div>";

echo "<span style='padding-left: 1%'>";
echo $vehicle->getDescription();
echo "</span>";

echo $vehicle;

?>