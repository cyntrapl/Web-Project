<?php
$host = "irkm0xtlo2pcmvvz.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$user = "lpuez6adwms7b0c7";
$password = "yhc7kbo90uou96qf";
$database = "dclop4vu9rnez9o6";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
