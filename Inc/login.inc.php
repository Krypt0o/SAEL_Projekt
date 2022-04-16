<?php
//nicht abrufbare seite für den User
if(isset($_POST["submit"])){
    //Es wird überprüft ob diese Seite mit einem Submit Knopf angesteuert wird damit sie nur funktioniert wenn ein Form eingereicht wird
    $Username = $_POST["Username"];
    $pwd = $_POST["Passwort"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    //Die delUser Funcktion wird angesprochen siehe functions.inc.php
    loginUser($conn, $Username, $pwd);
}
else {
    //Falls der User dirket auf diese seite zugreifen möchte wird der zurück zur login seite geleitet 
    header("location: ../login.php?error=invalidlogin");
    exit();
}