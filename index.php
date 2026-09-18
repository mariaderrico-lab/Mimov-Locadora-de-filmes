<?php
session_start();

if (isset($_SESSION['usuario_logado'])) {
    header('Location: View/catalogo.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Locadora de Filmes</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Mimov - Locadora de Filmes</h1>
        <h2>Login</h2>

        <?php if (isset($_GET['erro'])): ?>
            <p style="color: red; text-align: center;"><?= htmlspecialchars($_GET['erro']) ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">E-mail:</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Digite seu e-mail"
                required>
            <label for="senha">Senha:</label>
            <input
                type="password"
                id="senha"
                name="senha"
                placeholder="Digite sua senha"
                required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>

</html>