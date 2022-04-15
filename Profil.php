<?php
include_once 'header.php';
include_once 'Inc/functions.inc.php'
?>
    <body>
        <article class="Profile">
                <?php
                    echo "<section class='Profil'>
                    <h2>Guten Tag</h2>
                    <h4><br><br>" .$_SESSION["username"],"</h4></section>";

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