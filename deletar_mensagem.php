<?php

include("lib/conectar.php");
include('lib/protecao.php');
protecao(1);

// Pega o id da mensagem
$id = intval($_GET['id']);

// Deleta a mensagem a partir do id
$mysql_query = $mysqli->query("DELETE FROM mensagens WHERE id = '$id'") or die($mysqli->error);

header('Location: index.php?pg=mensagens'); // redireciona para o painel de mensagens


