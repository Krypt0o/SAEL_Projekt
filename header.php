<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function myFunction() {
            var element = document.body;
            element.classList.toggle("dark-mode");
            }
        </script>

        <link rel="stylesheet" href="stylesheet.css">
        <title>About | Spendenportal</title>
        <article class="nav-container">
            <section class="homeicon">
                <a href="Homepage.php"><img src="Bilder/hausicon.png" class="homeicon"></a>
            </section>
            <section class="FAQ">
                    <a href="FAQ.php" class="FAQ">FAQ!</a>
            </section>
            <section class="Projekte">
                <div class="dropdown">
                    <button class="dropbtn">Projekte</button>
                    <div class="dropdown-content">
                    <a href="Spenden Projekt 1.php">Stop Finning</a>
                    <a href="Spenden Projekt 2.php">Der Amazonas Brennt</a>
                    </div>
                </div>
            </section>   
            <section class="About">
                    <a href="About.php" class="About">Über Uns</a>
            </section>
            <?php
                if(isset($_SESSION["root"])){
                    echo "<a href='AdminPanel.php' class='Login'>Admin Oberfläche</a>";
                }
                if (isset($_SESSION["username"])){
                    echo "<a href='Profil.php' class='Login'>Profil</a>";
                    echo "<a href='Inc/logout.inc.php' class='Login'>Abmelden</a>";
                }
                else{
                    echo "<a href='register.php' class='Login'>Registrieren</a>";
                    echo "<a href='login.php' class='Login'>Anmelden</a>";
                }
            ?>
            <section class="Darkmode">
                <div>
                <label class="switch">
                    <input type="checkbox" onclick="myFunction()">
                    <span class="slider round"></span>
                </label>
                <label class="Darkmode">Dunkles Design</label>
                </div>
            </section>
        </article>
    </head>