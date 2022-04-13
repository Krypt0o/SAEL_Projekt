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
        header("location: ../Homepage.php");
        exit();

    }
}