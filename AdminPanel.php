<?php
include_once 'header.php';
require_once 'Inc/dbh.inc.php';
require_once 'Inc/functions.inc.php';
if(isset($_SESSION["root"])){
    
}
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
    AdminView($conn);
    ?>
</body>
</html>