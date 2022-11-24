<?php

include('lib/conectar.php');
include('lib/protecao.php');
protecao(1);

$sql_query = $mysqli->query("SELECT * FROM usuarios") or die($mysqli->error); // Seleciona todos os usuarios
$num_usuarios = $sql_query->num_rows;  // descobre a quantidade de usuarios selecionados


?>

<link rel="stylesheet" href="template/css/painel_admin.css">

<div class="form-background">
    <h1>Painel Admin</h1>
    <p><a href="?pg=mensagens" style="color: #323050;">Ver mensagens</a></p>
    <p><a href="?pg=cadastrar_usuario" style="color: #323050;">Cadastrar novo usuário</a></p>
    <h4>Usuários cadastrados: </h4>
    <table class="table">
            <thead>
            <tr>
                <th> id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if($num_usuarios == 0) {  // Caso não tenha usuarios, ?>
                <tr>
                    <td colspan="4">Nenhum usuário foi cadastrado</td>
                </tr>
            <?php } else {                // Caso tenha,

                while ($usuario = $sql_query->fetch_assoc()) {  // Mostra o id, nome e email dos usuarios na tabela 
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $usuario['id']; ?></th>
                        <td><a href="#" class="nome_usuario"><?php echo $usuario['nome']; ?></a></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><a href="index.php?pg=editar_usuario&id=<?php echo $usuario['id']; ?>">editar</a> | <a href="index.php?pg=deletar_usuario&id=<?php echo $usuario['id']; ?>">deletar</a></td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>
</div>

</html>