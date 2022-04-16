<?php
include_once 'header.php';
include_once 'Inc/functions.inc.php'
//alles was in header.php gescpeichert ist wird hier inkludiert so muss der head nicht auf jeder seite immer geschrieben sein + Funktionen aus functions.inc.php können abgerufen werden
?>
    <body>
        <article class="Profile">
                <?php
                //Über die Session variable username wird der Username auf dem Profil angezeigt 
                    echo "<section class='Profil'>
                    <h2>Guten Tag</h2>
                    <h4><br><br>" .$_SESSION["username"],"</h4></section>";
                //Ein Form Knopf der dafür sorgt das der user seinen eigenen Datenbank eintrag (Account) löschen kann siehe del.inc.php
                    echo '<section class="Profil2"><p>Eigenes Profil Löschen:</p>
                        <form method="POST" action="Inc/del.inc.php" class="delform">
                            <input type="submit" name="submit" value="Benuter Löschen">
                            <input type="hidden" name="del" value="'.$_SESSION["username"],'">
                        </form></section>'
                 ?>
            </section>
        </article>
    </body>
</html>