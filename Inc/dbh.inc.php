<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sae_projekt";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}