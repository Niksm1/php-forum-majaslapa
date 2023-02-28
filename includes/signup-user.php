<?php

// Pārbaude vai POST tika veikts ar nosaukumu submit
if(isset($_POST["submit"])){

    // Reģistrēšanās formas dati tiek saglabāti mainīgajos
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdConfirm = $_POST["pwdConfirm"];

    // Lai savienotos ar datubāzi  
    require_once 'db-handler.php';
    // Lai izmantoto vajadzīgās funkcijas
    require_once 'functions.php';

    // Error handlers
    if(emptyInputSignup($name, $email, $username, $pwd, $pwdConfirm) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdConfirm) !== false){
        header("location: ../signup.php?error=passwordincorect");
        exit();
    }
    if(uidExists($conn, $username, $email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    // Funkcija kas pievieno lietotāju datubāzei
    createUser($conn, $name, $email, $username, $pwd);

} else {
    header("location: ../signup.php");
    exit();
}

