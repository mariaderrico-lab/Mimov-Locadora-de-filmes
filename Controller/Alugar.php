<?php
session_start();
require_once __DIR__ . '/autoload_manual.php';
use Controller\LocacaoController;
if (!isset($_SESSION['usuario_logado']) || empty($_GET['id'])) {
    header('Location: Catalogo.php');
    exit;
}
$filmeId = $_GET['id'];
$usuarioId = $_SESSION['id'];
$locacaoController = new LocacaoController();
$resultado = $locacaoController->alugar([
    'filme_id' => $filmeId,
    'usuario_id' => $usuarioId
]);
if ($resultado['success']) {
    header('Location: Catalogo.php?sucesso=Filme%20alugado%20com%20sucesso!');
} else {
    header('Location: Catalogo.php?erro=Nao%20foi%20possivel%20alugar%20este%20filme.');
}
exit;
