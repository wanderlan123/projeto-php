<?php

if(!isset($_SESSION))
    session_start();

session_destroy(); // Apaga as Sessões de usuario e admin criadas no momento do login
header("Location: index.php"); // Redireciona para a pagina principal.

?>