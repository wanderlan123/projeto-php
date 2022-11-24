<link rel="stylesheet" href="template/css/header.css">

<header>
    <a href="/mini-projeto/" class="logo">TO-DO.list</a>
    <nav>
        <ul class="nav-link">
            <li><a href="index.php" class="home" <?php if (!isset($_GET['pg'])) { echo "style='color: #0088a9;'"; } ?>>Home</a></li>
            <li><a href="?pg=faleconosco" class="faleconosco" <?php if (isset($_GET['pg'])) { if ($_GET['pg'] == "faleconosco") { echo "style='color: #0088a9;'"; } } ?>>Fale Conosco</a></li>
            <li><a href="?pg=sobre" class="sobre" <?php if (isset($_GET['pg'])) { if ($_GET['pg'] == "sobre") { echo "style='color: #0088a9;'"; } } ?>>Sobre</a></li>

            

            <?php if (isset($_SESSION['admin'])) { if ($_SESSION['admin'] == 1) { ?>
                <li><a href="?pg=painel_admin" class="admin" <?php if (isset($_GET['pg'])) { if ($_GET['pg'] == "painel_admin") { echo "style='color: #0088a9;'"; } } ?>>Painel Admin</a></li>
            <?php } } ?>
        </ul>
    </nav>
    <div class="right-header">
        <?php if (empty($_SESSION)) { ?>
            <a href="?pg=login">Iniciar sessão</a>
            <a href="?pg=register" class="login-btn-header"><button>Começar</button></a>
        <?php } else { ?>
            <a href="logout.php">Logout</a>
            <a href="?pg=gerenciar_tarefas" class="login-btn-header"><button>Minha lista</button></a>
        <?php } ?>
    </div>

</header>