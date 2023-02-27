<?php

// Pārbaude vai POST tika veikts ar nosaukumu submit
if(isset($_POST["submit"])){

    // Login formas dati tiek saglabāti mainīgajos
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // Lai savienotos ar datubāzi      
    require_once 'db-handler.php';
    // Lai izmantoto vajadzīgās funkcijas
    require_once 'functions.php';

    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);

} else {
    header("location: ../login.php");
    exit();
}