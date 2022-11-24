<?php

include('lib/conectar.php');

if (isset($_POST['email']) || isset($_POST['senha'])) { // Quando o usuário apertar em logar,

    $erro = array();
    if (strlen($_POST['email']) == 0) {         // Caso esteja vazio o email,
        $erro[1] = 'Preencha seu email';        // Erro 1
    }

    if (strlen($_POST['senha']) == 0) {         // Caso esteja vazia a senha,
        $erro[2] = 'Preencha sua senha';        // Erro 2
    }

    if (count($erro) == 0) {            // Caso não tenha erros,

        $email = trim($_POST['email']); // Coleta os dados do formulario login
        $senha = trim($_POST['senha']); // 

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'"; // Codigo SQL
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error); // Seleciona o usuario que tiver o login e a senha iguais.

        $quantidade = $sql_query->num_rows; // Quantidade de usuarios que foi selecionado

        if ($quantidade == 1) { // Caso exista 1 usuario que tenha o login e senha iguais no banco de dados,

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();      // Inicia um Sessão caso não tenha
            }

            $_SESSION['usuario'] = $usuario['id'];    // Atribui a Sessão usuario o valor do id
            $_SESSION['admin'] = $usuario['admin'];   // Atribui a Sessao admin o nivel de permissão que o usuario tem (0 -> usuario comum / 1 -> admin)

            header('Location: index.php?pg=gerenciar_tarefas'); // Redireciona para a pagina de tarefas


        } else {                // Caso não exista usuário com o login e senha corretos, 
            $erro[3] = 'Falha ao logar! E-mail ou senha incorretos'; // Erro 3
        }
    }
}

?>

<link rel="stylesheet" href="template/css/login&register.css">

<div class="form-background">
    <h2>Login</h2>
    <form action="" method="POST">
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email">
        </div><?php if (isset($erro[1])) echo '<p class="erro_register">' . $erro[1] . '</p>'; ?><br> <!-- Caso tenha o erro 1, vai mostrar -->
        <div>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha">
        </div><?php if (isset($erro[2])) echo '<p class="erro_register">' . $erro[2] . '</p>'; ?><br> <!-- Caso tenha o erro 2, vai mostrar -->
        <?php if (isset($erro[3])) echo '<br><p class="erro_register">' . $erro[3] . '</p>'; ?> <!-- Caso tenha o erro 3, vai mostrar -->
        <input type="submit" value="Logar" class="login-btn">
        <a href="?pg=register" class="register-btn">Novo por aqui? Registrar</a>
    </form>
</div>
