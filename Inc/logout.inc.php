<?php
//Hier wird lediglich die Session die beim Login und im Head gestartet wurde zerstört damit der User ausgeloggt wird
//danach wird er auf die Homepage zurückgeleitet
session_start();
session_unset();
session_destroy();
header("Location: ../Homepage.php?error=logout");
exit();