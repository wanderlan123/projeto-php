<?php

if (isset($_POST['enviar'])) { // Se o usuario clicar no botão de enviar,

    include('lib/conectar.php');

    $nome = trim($_POST['nome']);          //
    $email = trim($_POST['email']);        //  Pega as informações do formulario Fale conosco
    $assunto = trim($_POST['assunto']);    //     
    $mensagem = trim($_POST['mensagem']);  //

    $sql_code = "INSERT INTO mensagens (nome, email, assunto, mensagem) VALUES ('$nome', '$email', '$assunto', '$mensagem')"; // Codigo SQL
    $sql_query = $mysqli->query($sql_code);  // Insere no banco de dados os dados do formulario fale conosco.

    $mensagem_sucesso = "Mensagem enviada com sucesso!";
}

?>


<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="template/css/cadastrar&editar.css">
    
<div>
    <a href="/mini-projeto/" class="voltar"><i class='bx bx-arrow-back'>Voltar</i></a>
    <h1>Converse com a nossa equipe</h1>
    <form action="" method="POST">
        <div>
            <label for="nome">Nome Completo</label><br>
            <input type="text" name="nome" required>
        </div><br>
        <div>
            <label for="email">Seu Email</label><br>
            <input type="email" name="email" required>
        </div><br>
        <div>
            <label for="tituloassunto">Assunto</label><br>
            <input type="text" name="assunto" required>
        </div><br>
        <div>
            <label for="assunto">Mensagem</label><br>
            <textarea name="mensagem" id="" cols="30" rows="10" required></textarea>
        </div><br><br>
        <button type="submit" class="botao-enviar" name="enviar" value="1">Enviar</button>
        <label for="" class="error"><?php if (!empty($mensagem_sucesso)) {    // Exibe a mensagem de sucesso quando enviado a mensagem!
                                        echo $mensagem_sucesso;
                                    } ?></label>

    </form>
</div>