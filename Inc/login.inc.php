<?php

if(isset($_POST["submit"])){
    $Username = $_POST["uid"];
    $pwd = $_POST["Passwort"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(invaliduidLogin($Username) !== false){
        header("location: ../login.php?error=invaliduid");
        exit();
    }

    loginUser($conn, $Username, $pwd);
}
else {
    header("location: ../login.php");
    exit();
}