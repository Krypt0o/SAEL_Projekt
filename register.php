<?php
include_once 'header.php';
?>
    <body>
        <div class="loginform">
            <form action="Inc/register.inc.php" method="post">
                <label for="Username" id="loginname">Username:</label><br>
                <input type="text" id="Username" name="uid" placeholder="Username" required><br><br>
                <label for="EMAIL" id="loginname">E-Mail:</label><br>
                <input type="email" id="Username" name="EMAIL" placeholder="E-Mail" required><br><br>
                <label for="Passwort" id="Passwort">Passwort:</label><br>
                <input type="password" id="Password" name="Passwort" placeholder="Passwort" required><br><br>
                <label for="Passwort2" id="Passwort">Passwort Wiederholen:</label><br>
                <input type="password" id="Password" name="Passwort2" placeholder="Passwort" required><br><br>
                <input id="Loginbutton" name="submit" type="submit" value="Login"><br>
            </form>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "invaliduid"){
                        echo "<p>Nimm einen gescheiten Benutzernamen</p>";
                    }
                    else if($_GET["error"] == "invalidemail"){
                        echo "<p>Nimme eine Richtige E-Mail Adresse</p>";
                    }
                    else if($_GET["error"] == "invalidpwdmatch"){
                        echo "<p>Die Passwörter stimmen nicht überein</p>";
                    }
                    else if($_GET["error"] == "usernametaken"){
                        echo "<p>Die E-Mail oder der Username wird bereits verwendet</p>";
                    }
                }
            ?>
        </div>


    </body>
</html>