<?php
include('lib/conectar.php');
include('lib/protecao.php');
protecao(1);

$id = $_GET['id']; // Pega o id da mensagem que quer ver

$sql_code = "SELECT * FROM mensagens WHERE id = '$id'"; // Código SQL
$sql_query = $mysqli->query($sql_code); // Seleciona a mensagem que quer ser vizualizada a partir do id
$mensagem = $sql_query->fetch_assoc(); // Atribui a variavel $mensagem a mensagem.

?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="template/css/view.css">

<div>
    <h1><?php echo $mensagem['assunto'] ?></h3>             <!-- Escreve o Titulo da mensagem -->
    <p><?php echo $mensagem['email'] ?></p>                 <!-- Escreve o email do usuario da mensagem -->
    <p>Nome: <?php echo $mensagem['nome'] ?></p><br><br>    <!-- Escreve o nome do remetente da mensagem -->
    <p><?php echo $mensagem['mensagem'] ?></p>              <!-- Escreve a mensagem -->
    
</div>