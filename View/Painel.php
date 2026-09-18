<?php
session_start();
if (!isset($_SESSION["usuario_logado"])) {
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mimov - Painel</title>
    <link rel="stylesheet" href="Css/painel.css">

</head>

<body>
<header>
    <div class="logo">
        MIMOV
    </div>
    <nav>

        <a href="painel.php" class="ativo">
            Início
        </a>

        <a href="catalogo.php">
            Catálogo
        </a>

        <a href="../Controller/Logout.php">
            Sair
        </a>
    </nav>
</header>

<main>
    <div class="painel">

        <h1>
            Mimov - Locadora de Filmes
        </h1>
        <h2>
            Seja bem-vindo!
        </h2>
        <p>
            Login efetuado com sucesso.
        </p>
        <a href="catalogo.php">
            Ver Catálogo
        </a>
    </div>

</main>
</body>
</html>