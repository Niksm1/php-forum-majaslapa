<?php

require_once 'functions.php';
require_once 'db-handler.php';

if(isset($_POST["ChangeName"])){

    $name = $_POST["name"];
    if($name == ""){
        header("location: ../profilePage.php?error=emptyInput");
        exit();
    }

    editUser($conn, "usersName", $name);

} else if(isset($_POST["ChangeEmail"])) {
    $email = $_POST["email"];

    if(invalidEmail($email) !== false){
        header("location: ../profilePage.php?error=invalidemail");
        exit();
    }

    editUser($conn, "usersEmail", $email);
    
} else if(isset($_POST["ChangePwd"])) {

    $pwd = $_POST["pwd"];
    $pwdConfirm = $_POST["pwdConfirm"];
    if($pwd == "" || $pwdConfirm == ""){
        header("location: ../profilePage.php?error=emptyInput");
        exit();
    }

    if(pwdMatch($pwd, $pwdConfirm) !== false){
        header("location: ../signup.php?error=passwordincorect");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    editUser($conn, "usersPwd", $hashedPwd);
    
}  else {
    header("location: ../profilePage.php");
    exit();
}