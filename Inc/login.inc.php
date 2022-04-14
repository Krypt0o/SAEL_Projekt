<?php

if(isset($_POST["submit"])){
    $Username = $_POST["Username"];
    $pwd = $_POST["Passwort"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    loginUser($conn, $Username, $pwd);
}
else {
    header("location: ../login.php?error=invalidlogin");
    exit();
}