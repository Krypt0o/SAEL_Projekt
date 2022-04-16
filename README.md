# SAEL_Projekt
Hallo Herr Röther da das Exportieren unserer Datenbank aufgrund des Bugs von phpMyAdmin mit der neuen php version nicht funktionert sind hier die SQL Befehle um die Datenbank zu erstellen

WICHTIG:
Die Datenbank muss den Namen "sae_projekt" haben damit alles funktioniert

CREATE TABLE `sae_projekt1`.`users` ( `usersID` INT(11) NOT NULL AUTO_INCREMENT , `usersName` VARCHAR(128) NOT NULL , `usersEmail` VARCHAR(128) NOT NULL , `usersPwd` VARCHAR(128) NOT NULL , `usersType` VARCHAR(128) NOT NULL DEFAULT 'user' , PRIMARY KEY (`usersID`)) ENGINE = InnoDB;

Danach muss über die Website über das Registrierungsformular ein neuer User angelegt werden.

Und als Letztes muss händisch in der Datenbank über phpMyAmdin der usersType auf "admin" geändert werden