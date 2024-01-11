<?php
include 'functions.php';

// Pobranie identyfikatora pojazdu z parametru GET
$vehicle = new Vehicle(intval($_GET['id']));

// Wyświetlenie nagłówka z nazwą pojazdu i miastem
echo "<h1>";
echo $vehicle->getName();
echo ", ";
echo $vehicle->getCity();
echo "</h1>";

// Wyświetlenie ikony zamykania informacji o pojeździe
echo "<span class='text-left' onclick='closeInfo()'>&#10006;</span>";

// Wyświetlenie obrazka pojazdu
echo "<div class='center-img'>";
echo $vehicle->getImage();
echo "</div>";

// Wyświetlenie opisu pojazdu
echo "<span style='padding-left: 1%'>";
echo $vehicle->getDescription();
echo "</span>";

// Wyświetlenie informacji o pojeździe w postaci tabeli HTML
echo $vehicle;
?>
