<?php
include('lib/conectar.php');
include('lib/protecao.php');
protecao(0);

$userid = $_SESSION['usuario'];

$sql_code = "SELECT * FROM tarefas WHERE userid = '$userid'";   // Codigo SQL
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);  // Seleciona todas as tarefas do usuario logado.
$num_tarefas = $sql_query->num_rows;                           // Vê quantas tarefas existem no banco de dados


?>

<link rel="stylesheet" href="template/css/checklist.css">

<div class="list">
    <form action="" method="post">
        <h1>Minha lista</h1>

        <?php if ($num_tarefas == 0) { ?>                       <!-- Caso não tenha tarefas, vai mostrar "Nenhuma tarefa!"  -->
            <br><br><span style="color: red;">Nenhuma tarefa!</span>
        <?php } else {
            while ($tarefa = $sql_query->fetch_assoc()) { ?>    <!-- Enquanto tiver tarefas, vai mostra-las 1 por 1 -->
                <label>
                    <a href="?pg=apagar_tarefa&id=<?php echo $tarefa['id'] ?>">
                        <input type="checkbox">
                        <i></i>
                        <span><?php echo $tarefa['tarefa'] ?></span>
                    </a>
                </label>
        <?php }
        } ?>
        <a href="?pg=cadastrar_tarefa"><label>Adicionar tarefa</label></a>
    </form>
</div>