<?php

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

function uidExists($conn, $Username, $Email) {
   $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../register.php?error=stmtfailed");
    exit();
   }

   mysqli_stmt_bind_param($stmt, "ss", $Username, $Email);
   mysqli_stmt_execute($stmt);

   $resultdata = mysqli_stmt_get_result($stmt);

   if($row = mysqli_fetch_assoc($resultdata)){
    return $row;
   }
   else{
       $result = false;
       return $result;
   }
   mysqli_stmt_close($stmt);
}

function createUser($conn, $Email, $Username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES(?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../register.php?error=stmtfailed");
     exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
 
    mysqli_stmt_bind_param($stmt, "sss", $Email, $Username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();

 }

function loginUser($conn, $Username, $pwd){
    $uidExists = uidExists($conn, $Username, $Username);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
   
    }

    $pwdHashed = $uidExists["usersPwd"];

    $checkpwd = password_verify($pwd, $pwdHashed);

    if($checkpwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();

    } elseif($checkpwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersID"];
        $_SESSION["username"] = $uidExists["usersName"];
        isAdmin($conn, $Username);

    }
}

function isAdmin($conn, $Username){
    $uidExists = uidExists($conn, $Username, $Username);
    if($uidExists["usersType"] === 'admin'){
        $_SESSION["root"] = "root";
        header("Location: ../AdminPanel.php?error=none");
        exit();
    }
    else{
        header("location: ../Homepage.php");
        exit();
    }
}

function AdminView($conn){
    $sql = "SELECT * FROM users;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $resultdata = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($resultdata))
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