<?php
session_start();
require_once __DIR__ . '/autoload_manual.php';

use Controller\AuthController;

if (isset($_GET['acao']) && $_GET['acao'] === 'logout') {
    session_unset();
    session_destroy();

    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $authController = new AuthController();
    $resultado = $authController->login($email, $senha);

    if ($resultado['success']) {
        $_SESSION['usuario_logado'] = $resultado['user'];
        $_SESSION['id'] = $resultado['user']['id'];
        $_SESSION['email'] = $resultado['user']['email'];

        header('Location: View/catalogo.php');
        exit;
    } else {
        $mensagemErro = urlencode($resultado['message']);
        header("Location: index.php?erro={$mensagemErro}");
        exit;
    }
}

header('Location: index.php');
exit;
