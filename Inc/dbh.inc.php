<?php
//Alle variablen die für die connection zur Datenbank benötigt werden werden hier festgelegt
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sae_projekt";

//Über die vordefinierte function mysqli_connect und den variablen die vorher festgelegt wurden wird eine Datenbank verbindung aufgebaut
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

//falls die connection fehlschlägt wird der error code ausgegeben
if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}