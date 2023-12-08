<?php
include 'Vehicle.php';
include 'Database.php';
                        if ($_SERVER['REQUEST_METHOD'] === 'POST')
                        {
                            $description = $_POST['description'];
                            $description = str_replace(['"', '+'], '', $description);
                            if(Vehicle::insertVehicle($_POST['type'], $_POST['name'], $_POST['countryOfOrigin'], $_POST['productionYear'],
                             $_POST['engineType'], $description, $_POST['city']))
                             {
                                echo "Vehicle added";
                                header( "refresh:5;url=../index.php?idp=7" );
                             }
                             else
                             {
                                echo "Failed to add a vehicle";
                                header( "refresh:5;url=../index.php?idp=7" );
                             }
                        }
?>