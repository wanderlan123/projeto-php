<?php
include('lib/protecao.php');
protecao(1); // proteção admin
if (isset($_POST['email']) || isset($_POST['senha'])) {  // Caso clique no botão registrar,
    include('lib/conectar.php');

    $nome = trim($_POST['nome']);               //
    $email = trim($_POST['email']);             //  pega as informações do formulario registrar
    $senha = trim($_POST['senha']);             //
    $senha2 = trim($_POST['senha2']);           //
    $cargo = $_POST['cargo'];               //

    $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'") or die($mysqli->error); // Verifica se o email de
    $qntd = $sql_query->num_rows;                                                                        // cadastro já existe no banco de dados

    $erro = array();
    if (empty($nome))  // Caso o campo nome estiver vazio
        $erro[1] = "Preencha o nome"; // Erro 1

    if (empty($email)) // Caso o campo email estiver vazio
        $erro[2] = "Preencha o e-mail"; // Erro 2

    if ($qntd > 0) {  // Caso exista um email cadastrado igual ao que quer cadastrar
        $erro[3] = "E-mail já cadastrado"; // Erro 3
    }

    if (empty($senha)) // Caso o campo senha esteja vazio
        $erro[4] = "Preencha a senha"; // Erro 4

    if ($senha2 != $senha) // Caso a as senhas 1 e 2 não forem iguais 
        $erro[5] = "As senhas não batem"; // Erro 5


    if (count($erro) == 0) { // Caso não tenha erros,

        // Adiciona no banco de dados as informações do formulario Registrar;
        $mysqli->query("INSERT INTO usuarios (nome, email, senha, admin) VALUES(
            '$nome', 
            '$email', 
            '$senha',
            0
        )");
        header('Location: index.php?pg=painel_admin'); // Direciona para a pagina principal
    }
}
?>

<link rel="stylesheet" href="template/css/cadastrar&editar.css">


<div class="form-background">
    <h2>Registrar</h2>
    <form action="" method="POST">
        <div>
            <label for="email">Nome</label><br>
            <input type="text" name="nome">
        </div><?php if (isset($erro[1])) echo '<p class="erro_register">' . $erro[1] . '</p>'; ?><br> <!-- Mostra a mensagem caso exista o erro 1 -->
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email">
        </div><?php if (isset($erro[2])) echo '<p class="erro_register">' . $erro[2] . '</p>'; ?><br> <!-- Mostra a mensagem caso exista o erro 2 -->
        <div>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha">
        </div><?php if (isset($erro[4])) echo '<p class="erro_register">' . $erro[4] . '</p>'; ?><br> <!-- Mostra a mensagem caso exista o erro 4 -->
        <div>
            <label for="senha">Repetir senha</label><br>
            <input type="password" name="senha2">
        </div><?php if (isset($erro[5])) echo '<p class="erro_register">' . $erro[5] . '</p>'; ?><br> <!-- Mostra a mensagem caso exista o erro 5 -->
        <div>
            <select name="cargo" class="form-control">
                <option value="0">Usuário</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <input type="submit" name="registrar" value="Registrar" class="login-btn">
        <?php if (isset($erro[3])) echo '<p class="erro_register">' . $erro[3] . '</p>'; ?> <!-- Mostra a mensagem caso exista o erro 3 -->
    </form>
</div>
