<?php

//Replace these placeholders with your actual database information

// $hostname = 'localhost';
// $username = 'sophato1_admin'; 
// $password = 'Unionholding2020!'; 
// $database = 'sophato1_ma_thechnologies_gestion_facturation';
// $url = 'https://sophatour.ma/MA/';


$hostname = 'localhost';
$username = 'root'; 
$password = ''; 
$database = 'ma_thechnologies_gestion_facturation'; 
$url = 'http://localhost/MA_v3/';


// Create a connection to the database
try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>

