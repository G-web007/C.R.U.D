<?php

$servername = "localhost";
$username = "root";
$password = "";

try{
    // CHECK THE CONNECTION
    $conn = new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
    // SET ERROR MODE TO EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection Failed:" . $e->getMessage();   
}


?>