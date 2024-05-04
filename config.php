<?php

$servername="localhost";
$DBuser = "root";
$DBpassword = "";
$DBname = "autoshop";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
    $e->getMessage();
}
?>