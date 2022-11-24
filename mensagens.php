<?php

include('lib/conectar.php');
include('lib/protecao.php');
protecao(1);

$sql_query = $mysqli->query("SELECT * FROM mensagens") or die($mysqli->error); // Seleciona todas as mensagens
$num_mensagens = $sql_query->num_rows; // descobre quantas mensagens foram selecionadas


?>

<link rel="stylesheet" href="template/css/painel_admin.css">

<div class="form-background">
    <h1>Painel Admin</h1>
    <p><a href="?pg=painel_admin" style="color: #323050;">Ver usuários</a></p>
    <h4>Mensagens: </h4>
    <table class="table">
            <thead>
            <tr>
                <th> id</th>
                <th>Assunto</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if($num_mensagens == 0) { // Caso não tenha nenhuma mensagem,   ?> 
                <tr>
                    <td colspan="4">Nenhuma mensagem no banco de dados.</td>
                </tr>
            <?php } else { // Caso tenha,
                     
                while ($mensagem = $sql_query->fetch_assoc()) {  // Mostra todas as mensagens
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $mensagem['id']; ?></th>
                        <td><a href="#" class="nome_usuario"><?php echo $mensagem['assunto']; ?></a></td>
                        <td><?php echo $mensagem['email']; ?></td>
                        <td><a href="index.php?pg=visualizar_mensagem&id=<?php echo $mensagem['id']; ?>">visualizar</a> | <a href="index.php?pg=deletar_mensagem&id=<?php echo $mensagem['id']; ?>">deletar</a></td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>
</div>

</html>