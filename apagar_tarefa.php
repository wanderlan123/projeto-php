<?php

include("lib/conectar.php");
include('lib/protecao.php');


protecao(0); // Protege contra o acesso de usuários sem estarem logado
$id = intval($_GET['id']); // Pega o valor do ID da tarefa

$mysql_query = $mysqli->query("DELETE FROM tarefas WHERE id = '$id'") or die($mysqli->error); // Apaga a tarefa

header('Location: index.php?pg=gerenciar_tarefas'); // Redireciona para a pagina gerenciar_tarefas



