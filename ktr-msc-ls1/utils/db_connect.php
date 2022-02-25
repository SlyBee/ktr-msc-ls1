<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "ktr-msc-ls1";

$connexion = mysqli_connect($host, $user, $password,$database);

if (mysqli_connect_errno()) {
    echo "Échec lors de la connexion à MySQL : " . mysqli_connect_error();
} else {
    // echo "Connexion a la database ".$database." réussie";
}