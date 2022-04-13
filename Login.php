<?php
include_once 'header.php';
?>
    <body>
        <div class="loginform">
            <form action="Login.php" method="post">
                <label for="Username" id="loginname">Username:</label><br>
                <input type="text" id="Username" name="Username" placeholder="Username"><br><br>
                <label for="Passwort" id="Passwort">Passwort:</label><br>
                <input type="password" id="Password" name="Passwort" placeholder="Passwort"><br><br>
                <input id="Loginbutton" type="submit" value="Login"><br>
            </form>
            <a href="register.php">Hier Registrieren</a>
        </div>
    </body>
</html>