<?php

// Nodefinē datubāzes autentifikācijas vērtības
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "project";

// Izveido savienojumu ar datubāzi
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn){
    die("Connection fialed " . mysqli_connect_error());
}
