<?php

    // database
    // =========================================================
    // Declare
    //$connection = mysqli_connect("localhost","root","","vrdb");
    $connection = mysqli_connect("localhost","root","","vrdb");

    // Define Date
    date_default_timezone_set("Asia/Manila");
    $date = new DateTime();
    $dateResult = $date->format('Y-m-d H:i:s');
    $dateOnlyResult = $date->format('Y-m-d');
    
?>