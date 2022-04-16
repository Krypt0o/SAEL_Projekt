<?php
//legt fest das die in pregmatch angegebenen zeichen zulässig für den Benutzernamen sind
function invaliduid($Username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $Username)){
        $result = true;
    }
    else
{
    $result = false;
}
return $result;
}
//Überprüft die eingegebene Email auf gültigkeit also ein @
function invalidEmail($Email) {
    $result;
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
else
{
    $result = false;
}
return $result;
}
//Funktion zum überprüfen der Passwörter bei der Registrierung das beide angegebenen Passwörter übereinstimmen
function pwdMatch($pwd, $pwd2) {
    $result;
    if($pwd !== $pwd2){
        $result = true;
    }
else
{
    $result = false;
}
return $result;
}
//stellt eine Verbindung zur datenbank her hund überprüft ob der angegebene Nutzername oder Email adresse bereits existiert
function uidExists($conn, $Username, $Email) {
   $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../register.php?error=stmtfailed");
    exit();
   }

   mysqli_stmt_bind_param($stmt, "ss", $Username, $Email);
   //Die SQL Abfrage wird per bind zusammengebaut um SQL Injections zu verhindern
   mysqli_stmt_execute($stmt);

   $resultdata = mysqli_stmt_get_result($stmt);
//Alle gefetchten Daten aus der datenbank werden in ein Asscociative array gespeichert (macht die arbeit mit dem array um einiges einfacher)
   if($row = mysqli_fetch_assoc($resultdata)){
    return $row;
   }
   else{
       $result = false;
       return $result;
   }
   mysqli_stmt_close($stmt);
}


//Es wird eine Verbindung zur Datenbak aufgebaut um einen neuen User anzulegen.
function createUser($conn, $Email, $Username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES(?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../register.php?error=stmtfailed");
     exit();
    }
//Das in der Registrierung angebene Passwort wird verschlüsselt.
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
 //Die von der Registrierung angebenen Daten werden an die Platzhalter (?) in $sql gebindet und das SQL statement danach ausgeführt.
    mysqli_stmt_bind_param($stmt, "sss", $Email, $Username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //Nach der Erfolgreichen Ausführung wird man auf die Login Page geleitet
    header("location: ../login.php?error=none");
    exit();

 }

function loginUser($conn, $Username, $pwd){
    //Es werden alle Daten von der Datenbank abgerufen s.Z.38
    $uidExists = uidExists($conn, $Username, $Username);
//Falls beim Login ein nicht existierender Username angegeben wird kommt ein Error mit wronglogin
    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
   
    }
//Das verschlüsselte Password aus der Datenbank wird in eine variable geschrieben
    $pwdHashed = $uidExists["usersPwd"];
//mit Password_verify kann das eingegebene Passwort mit dem verschlüsselten Passwort abgeglichen werden
    $checkpwd = password_verify($pwd, $pwdHashed);
//Falls die Passwörter nicht übereinstimmen kommt wieder der Fehler wronglogin
    if($checkpwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
//Falls das Passwort stimmt wird eine neue Session gestartet diese wird gebraucht für alles was nur Userspezifisch angezeigt werden soll
    } elseif($checkpwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersID"];
        $_SESSION["username"] = $uidExists["usersName"];
        isAdmin($conn, $Username);

    }
}
//Hier wird überprüft ob es sich bei dem Angemeldeten User um einen Admin handelt oder einen normalen User
function isAdmin($conn, $Username){
    $uidExists = uidExists($conn, $Username, $Username);
    //Die Spalte usersType wird geprüft und falls es sich um einen Admin handelt wird eine globale Session variable mit roor gesetzt
    //diese wird benutzt um das AdminPanel abrufbar zu machen
    if($uidExists["usersType"] === 'admin'){
        $_SESSION["root"] = "root";
        header("Location: ../AdminPanel.php?error=none");
        exit();
    }
    //Falls es sich nicht um einen Admin handelt wird der User ganz normal wieder auf die Homepage geleitet
    else{
        header("location: ../Homepage.php");
        exit();
    }
}
//Hier wird der Inhalt der Admin ansicht zusammen gebaut.
//Es werden alle User Daten außer das Passwort von der der Datenbank abgerufen und es wird eine Liste gebaut mit dem Userdaten.
//Zusätzlich gibt es einen Button mit dem man die User Löschen
function AdminView($conn){
    $sql = "SELECT * FROM users;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $resultdata = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($resultdata))
    //In der Admin Ansciht wird ein bestimmter Hidden Value mit übermittelt damit es sich beim löschen von der Normalen Löschung von einem User unterscheidet
        echo '<table class="admintable">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Typ</th>
                </tr>
                <tr>
                    <td>'
                        . $row['usersID'],
                    '</td>
                    <td>'
                        . $row['usersName'],
                    '</td>
                    <td>'
                        . $row["usersEmail"],
                    '</td>
                    <td>'
                        . $row["usersType"],
                    '</td>
                    <td>
                    <form method="POST" action="Inc/del.inc.php">
                        <input type="submit" name="submit" value="Benuter Löschen">
                        <input type="hidden" name="del" value="'.$row["usersName"],'">
                        <input type="hidden" name="admin" value="1">
                    </form>
                    </td>
                </tr>',
            "</table>";
}
//Funktion zum löschen des Users mit den Daten die von del.in.php kommen
function delUser($conn, $Username){
    $sql = "DELETE FROM users WHERE usersName=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../AmdinPanel.php?error=stmtfailed");
     exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $Username,);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
   }