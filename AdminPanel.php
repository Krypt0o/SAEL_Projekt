<?php
include_once 'header.php';
require_once 'Inc/dbh.inc.php';
require_once 'Inc/functions.inc.php';
//Falls die session variable in functions.inc.php gesetzt wurde kann der admin auf das Panel zugreifen
if(isset($_SESSION["root"])){
    
}
//andernfalls wird der User zurück auf die Homepage geleitet
else{
    header("Location: ./Homepage.php?error=unathorizedaccess");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Spendenportal</title>
</head>
<body>
    <h1 class="FAQtext">Hallo Admin, dies sind die derzeit angelegten User:</h1>
    <?php
    //AdminView Funktion wird ausgeführt siehe functions.inc.php
    AdminView($conn);
    ?>
</body>
</html>