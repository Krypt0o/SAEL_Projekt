<?php
include_once 'header.php';
?>
    <body>
        <div class="loginform">
            <form action="Login.php" method="post">
                <label for="Username" id="loginname">Username:</label><br>
                <input type="text" id="Username" name="Username" placeholder="Username"><br><br>
                <label for="EMAIL" id="loginname">E-Mail:</label><br>
                <input type="email" id="Username" name="EMAIL" placeholder="E-Mail"><br><br>
                <label for="Passwort" id="Passwort">Passwort:</label><br>
                <input type="password" id="Password" name="Passwort" placeholder="Passwort"><br><br>
                <label for="Passwort2" id="Passwort">Passwort:</label><br>
                <input type="password" id="Password" name="Passwort2" placeholder="Passwort"><br><br>
                <input id="Loginbutton" type="submit" value="Login"><br>
            </form>
        </div>
    </body>
</html>