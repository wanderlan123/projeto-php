<?php
include('lib/protecao.php');
protecao(0); // Protege contra o acesso de usuários sem estarem logado

if (isset($_POST['tarefa'])) {  // Se enviar a tarefa 
    include('lib/conectar.php'); // conecta com o banco de dados

    $userid = $_SESSION['usuario']; // Pega o id do usuario
    $tarefa = trim($_POST['tarefa']); // Pega a tarefa e armazena na variavel $tarefa

    $erro = array(); // cria uma lista vazia chamada erro
    if (empty($tarefa)) // Caso esteja vazio a tarefa, atribui 1 erro
        $erro[1] = "Preencha o nome da tarefa"; 

    if (empty($descricao)) {
        $descricao = ""; 
    }


    if (count($erro) == 0) {
        $mysqli->query("INSERT INTO tarefas (userid, tarefa, descricao, situacao) VALUES(
            '$userid', 
            '$tarefa', 
            '$descricao',
            0
        )"); // Insere na tabela 'tarefas' 


        header('Location: index.php?pg=gerenciar_tarefas'); // Redireciona para a pagina de gerenciar_tarefas
    }
}
?>

<link rel="stylesheet" href="template/css/cadastrar&editar.css">
        

<div class="form-background">
    <h2>Cadastrar nova tarefa</h2>
    <form action="" method="POST">
        <div>
            <label for="email">Tarefa</label><br>
            <input type="text" name="tarefa" autocomplete="off">
        </div><?php if (isset($erro[1])) echo '<p class="erro_register">' . $erro[1] . '</p>'; ?><br> <!-- Caso tenha um erro, exibe uma Mensagem de erro --> 
        <input type="submit" value="Adicionar" class="login-btn">
    </form>
</div>
