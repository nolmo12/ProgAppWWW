<?php
    if(isset($_GET['err']))
    {
        $error = $_GET['err'];
    }
    echo "ERROR: $error";
    switch($error)
    {
        case 404:
            throw new Exception("The page couldn't be loaded!");
    }
?>