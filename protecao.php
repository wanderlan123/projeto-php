<?php
// Funcao protecao para projeter contra usuarios não logados e para parte administrativa
function protecao($admin)
{
    if (!isset($_SESSION)) { // Caso não tenha iniciado uma Session,
        session_start();     // Inicia uma session
    }

    if (!isset($_SESSION['usuario'])) { // Caso criado a Session usuario (feito login),
        header('Location: index.php?pg=login'); // Vai ser redirecionado para pagina de login
    }

    if ($admin == 1 && $_SESSION['admin'] != 1) { // Caso a proteção seja de administrador e não tiver permissão,
        header('Location: index.php'); // Vai ser redirecionado para pagina principal
    }
}


// 0 -> Requer login
// 1 -> Apenas Admin