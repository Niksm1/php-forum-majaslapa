<?php

if(isset($_POST["submit"])){

    $userInput = $_POST["userInput"];
    session_start();
    $userId = $_SESSION["userid"];

    require_once 'db-handler.php';
    require_once 'functions.php';

    if(emptyPost($userInput) !== false){
        header("location: ../createPost.php?error=emptyinput");
        exit();
    }
    
    createPost($conn, $userInput, $userId);

} else {
    header("location: ../createPost.php");
    exit();
}