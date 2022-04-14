<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if(isset($_POST["submit"])){
    $Username = $_POST["del"];
    delUser($conn, $Username);


    header("Location: ../AdminPanel.php");
    exit();
}