<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if(isset($_POST["submit"])){
    $Username = $_POST["del"];
    delUser($conn, $Username);

    if($_POST["admin"] == "1"){
        header("Location: ../AdminPanel.php");
        exit();
    }
    else{
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../register.php?error=userdeleted");
    }
}