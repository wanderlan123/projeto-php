<?php
include('lib/protecao.php');
include('lib/conectar.php');
protecao(1);

$id = $_GET['id'];
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
$usuario = $sql_query->fetch_assoc();


if (isset($_POST['editar'])) {

    $nome = trim($_POST['nome']);       //
    $email = trim($_POST['email']);     //
    $senha = trim($_POST['senha']);     // pega as informações do formulario 
    $senha2 = trim($_POST['senha2']);   //
    $cargo = $_POST['cargo'];           //

    $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'") or die($mysqli->error);  // Pega as informações do usuario a partir do email
    $qntd = $sql_query->num_rows; // vê se conseguiu pegar as informações do usuario

    $erro = array();
    if (empty($nome)) // Caso seja enviado vazio o nome,
        $erro[1] = "Preencha o nome";   // Erro 1

    if (empty($email)) // Caso seja enviado vazio o email,
        $erro[2] = "Preencha o e-mail"; // Erro 2

    if ($qntd > 0 && $usuario['email'] != $email) { // Se editar o email e existir um email igual ao que selecionou,
        $erro[3] = "E-mail já cadastrado"; // Erro 3
    }
    

    // Caso não tenha nenhum erro: 
    if (count($erro) == 0) { 
        $sql_code = "UPDATE usuarios SET nome = '$nome', email = '$email', admin = '$cargo' WHERE id = '$id'"; // Código sql para atualizar os dados de nome, email, admin do usuario

        // Caso não tenha sido alterada a senha, 
        if(!empty($senha)) {
            $sql_code = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha', admin = '$cargo' WHERE id = '$id'"; // Código sql para atualizar os dados de nome, email, senha, admin do usuario.
        }

        $mysqli->query($sql_code); // Atualiza os dados

        header('Location: index.php?pg=painel_admin'); // Redireciona para o Painel Admin

    }
}
?>
<link rel="stylesheet" href="template/css/cadastrar&editar.css">

<div class="form-background">
    <h2>Editar Usuário</h2>
    <form action="" method="POST">
        <div>
            <label for="email">Nome</label><br>
            <input type="text" name="nome" value="<?php echo $usuario['nome'];?>">
        </div><?php if (isset($erro[1])) echo '<p class="erro_register">' . $erro[1] . '</p>'; ?><br> <!-- Caso tenha o erro 1, vai mostrar -->
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" value="<?php echo $usuario['email'];?>">
        </div><?php if (isset($erro[2])) echo '<p class="erro_register">' . $erro[2] . '</p>'; ?><br> <!-- Caso tenha o erro 2, vai mostrar -->
        <div>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha">
        </div><?php if (isset($erro[4])) echo '<p class="erro_register">' . $erro[4] . '</p>'; ?><br> <!-- Caso tenha o erro 4, vai mostrar -->
        <div>
            <label for="senha">Repetir senha</label><br>
            <input type="password" name="senha2">
        </div><?php if (isset($erro[5])) echo '<p class="erro_register">' . $erro[5] . '</p>'; ?><br> <!-- Caso tenha o erro 3, vai mostrar -->
        <div>
            <select name="cargo" class="form-control">
                <option value="0">Usuário</option>
                <option value="1" <?php if($usuario['admin']) echo 'selected';?>>Admin</option> <!-- Caso o usuario editado for admin, vai deixar selecionado a opção admin -->
            </select>
        </div>
        <input type="submit" name="editar" value="Editar" class="login-btn">
        <?php if (isset($erro[3])) echo '<p class="erro_register">' . $erro[3] . '</p>'; ?> <!-- Caso tenha o erro 3, vai mostrar -->
    </form>
</div>