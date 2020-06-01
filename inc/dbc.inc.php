<?php

//conexao a base de dados
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tidder";

$conex = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conex) {
    die("Conexao Falhada:" . mysqli_connect_error());
}

?>