<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "music_store";

//Fm34TFQ2*

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
