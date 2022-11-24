<?php 

$hostname = "localhost";
$username = "root"; // Nome padrão xampp
$password = "";
$database = "projetophp"; // Nome do banco de dados.

$mysqli = new mysqli($hostname, $username, $password, $database); // Cria um novo banco de dados

if ($mysqli->connect_errno) { // Caso tenha algum erro de conexão com o banco de dados, escreve a falha logo após.
    die("Falha ao conectar ao banco de dados? " . $mysqli->error); 
}

?>
