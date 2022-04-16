<?php
if(isset($_POST["submit"])){
//nicht abrufbare seite für den User
//Alle Variablen aus der Form von register.php werden in variablen geschrieben
    $Username = $_POST["uid"];
    $Email = $_POST["EMAIL"];
    $pwd = $_POST["Passwort"];
    $pwd2 = $_POST["Passwort2"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Error handler falls der Angebene Username nicht mit den vorgaben übereinstimmt
    if(invaliduid($Username) !== false){
        header("location: ../register.php?error=invaliduid");
        exit();
    }
    //Error handler falls bereits ein User mit der Email existiert
    if(invalidEMail($Email) !== false){
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    //Error handler falls die beiden angegebenen Passwörter nicht übereinstimmen
    if(pwdMatch($pwd, $pwd2) !== false){
        header("location: ../register.php?error=invalidpwdmatch");
        exit();
    }
    //Error handler falls bereits ein User mit dem Usernamen existiert
    if(uidExists($conn, $Username, $Email) !== false){
        header("location: ../register.php?error=usernametaken");
        exit();
    }
    //function zur erstellung des Datenbank eintrags wird gecallt siehe functions.inc.php
    createUser($conn, $Username, $Email, $pwd);

}
else{
    //falls der User direkt auf diese seite zugreifen will wird er zurück auf die register.php seite geleitet
    header("location: ../register.php");
}