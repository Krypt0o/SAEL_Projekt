
<?php
//nicht abrufbare seite für den User
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
//Es wird überprüft ob diese Seite mit einem Submit Knopf angesteuert wird damit sie nur funktioniert wenn ein Form eingereicht wird
if(isset($_POST["submit"])){
    //Der Username wird aus der POST Form geholt dieser wird als Hidden übertragen damit der User keinen Einfluss darauf hat
    $Username = $_POST["del"];
    //Die delUser Funcktion wird angesprochen 
    delUser($conn, $Username);
//Falls es sich um einen Löschung vom Admin Panel handelt wird der Admin wieder auf das Admin Panel zurückgeleitet
    if($_POST["admin"] == "1"){
        header("Location: ../AdminPanel.php");
        exit();
    }
    //Falls es sich um einen User handelt der seinen eigenen Account gelöscht hat wird er auf die Registrierungs seite zurück geleitet
    else{
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../register.php?error=userdeleted");
    }
}