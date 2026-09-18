<?php
session_start();
require_once __DIR__ . '/../autoload_manual.php';

use Controller\FilmeController;

if (!isset($_SESSION['usuario_logado']) || empty($_GET['id'])) {
    header('Location: Catalogo.php');
    exit;
}

$resultado = (new FilmeController())->rentMovie([
    'filme_id' => $_GET['id'],
    'usuario_id' => $_SESSION['id']
]);

$mensagem = $resultado['success'] ? 'sucesso=Filme alugado com sucesso!' : 'erro=Nao foi possivel alugar este filme.';

header('Location: Catalogo.php?' . $mensagem);
exit;