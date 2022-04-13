<?php
if(isset($_POST["submit"])){

    $Username = $_POST["uid"];
    $Email = $_POST["EMAIL"];
    $pwd = $_POST["Passwort"];
    $pwd2 = $_POST["Passwort2"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(invaliduid($Username) !== false){
        header("location: ../register.php?error=invaliduid");
        exit();
    }

    if(invalidEMail($Email) !== false){
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if(pwdMatch($pwd, $pwd2) !== false){
        header("location: ../register.php?error=invalidpwdmatch");
        exit();
    }

    if(uidExists($conn, $Username, $Email) !== false){
        header("location: ../register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $Username, $Email, $pwd);

}
else{
    header("location: ../register.php");
}