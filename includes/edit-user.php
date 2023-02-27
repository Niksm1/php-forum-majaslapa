<?php

require_once 'functions.php';
// Lai izmantoto vajadzīgās funkcijas
require_once 'db-handler.php';

// Pārbaude vai POST tika veikts ar nosaukumu ChangeName
if(isset($_POST["ChangeName"])){

    // Vārda Uzvārda dati tiek saglabāti mainīgajā
    $name = $_POST["name"];
    // Ja dati ir tukši
    if($name == ""){
        // URL izmest error
        header("location: ../profilePage.php?error=emptyInput");
        exit();
    }

    // Rediģēt lietotāja vārdu un uzvārdu (editUser funkcija tiek ņemta no functions.php faila)
    editUser($conn, "usersName", $name);

// Pārbaude vai POST tika veikts ar nosaukumu ChangeEmail
} else if(isset($_POST["ChangeEmail"])) {
    $email = $_POST["email"];

    if(invalidEmail($email) !== false){
        header("location: ../profilePage.php?error=invalidemail");
        exit();
    }

    editUser($conn, "usersEmail", $email);
    
// Pārbaude vai POST tika veikts ar nosaukumu ChangePwd
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