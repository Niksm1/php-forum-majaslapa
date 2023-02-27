<?php
// Pārbaude vai POST tika veikts ar nosaukumu submit
if(isset($_POST["submit"])){

    $postId = $_POST["postid"];

    // Lai savienotos ar datubāzi      
    require_once 'db-handler.php';
    // Lai izmantoto vajadzīgās funkcijas
    require_once 'functions.php';
    
    deletePost($conn, $postId);

} else {
    header("location: ../index.php");
    exit();
}