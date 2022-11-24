<?php

include("lib/conectar.php");
include('lib/protecao.php');
protecao(1);
$id = intval($_GET['id']); // pega o id do usuario

$mysql_query = $mysqli->query("DELETE FROM usuarios WHERE id = '$id'") or die($mysqli->error); // Deleta o usuario

header('Location: index.php?pg=painel_admin'); // Redireciona para o painel_admin



