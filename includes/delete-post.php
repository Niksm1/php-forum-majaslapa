<?php

if(isset($_POST["submit"])){

    $postId = $_POST["postid"];

    require_once 'db-handler.php';
    require_once 'functions.php';
    
    deletePost($conn, $postId);

} else {
    header("location: ../index.php");
    exit();
}