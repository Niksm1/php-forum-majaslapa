<?php

// Nodefinē datubāzes autentifikācijas vērtības
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "project";

// Izveido savienojumu ar datubāzi
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// Ja savienojums neizdodas, izmest error
if (!$conn){
    die("Connection fialed " . mysqli_connect_error());
}
