<?php

// Pārbaude vai POST tika veikts ar nosaukumu submit
if(isset($_POST["submit"])){

    $userInput = $_POST["userInput"];
    session_start();
    $userId = $_SESSION["userid"];

    // Lai savienotos ar datubāzi
    require_once 'db-handler.php';
    // Lai izmantoto vajadzīgās funkcijas
    require_once 'functions.php';

    // Pārbaude vai liletotāja raksts ir tukšs (emptyPost funkcija tiek ņemta no functions.php faila)
    if(emptyPost($userInput) !== false){
        // Lietotājam URL tiek norādīts error
        header("location: ../createPost.php?error=emptyinput");
        exit();
    }
    
    // Publicē jaunu rakstu (createPost funkcija tiek ņemta no functions.php faila)
    createPost($conn, $userInput, $userId);

} else {
    header("location: ../createPost.php");
    exit();
}