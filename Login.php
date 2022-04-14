<?php
include_once 'header.php';
?>
    <body>
        <div class="loginform">
            <form action="Inc/login.inc.php" method="post">
                <label id="loginname">Username:</label><br>
                <input type="text" id="Username" name="Username" placeholder="Username" required><br><br>
                <label id="Passwort">Passwort:</label><br>
                <input type="password" id="Password" name="Passwort" placeholder="Passwort" required><br><br>
                <input name="submit" id="Loginbutton" type="submit" value="Login"><br>
            </form>
            <a href="register.php">Hier Registrieren</a>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "wronglogin"){
                    echo "<p>Benutzername oder Passwort Inkorrekt!</p>";
                }
            }
            ?>
        </div>
    </body>
</html>