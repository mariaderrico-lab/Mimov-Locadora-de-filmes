<?php
namespace Controller;
use Database\Conexao;
use PDO;

class LocacaoController {

    public function alugar($dados) {
        $filme_id = $dados['filme_id'] ?? null;
        $usuario_id = $dados['usuario_id'] ?? null;

        if (empty($filme_id) || empty($usuario_id)) {
            return [
                'success' => false,
                'message' => 'Filme ou usuário não informados.'
            ];
        }

        try {
            $pdo = Conexao::getConexao();
            $sql = "INSERT INTO locacoes (filme_id, usuario_id, status) VALUES (:filme_id, :usuario_id, 'alugado')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':filme_id' => $filme_id,
                ':usuario_id' => $usuario_id
            ]);

            $sqlFilme = "UPDATE filmes SET quantidade_disponivel = quantidade_disponivel - 1 WHERE id = :filme_id";
            $stmtFilme = $pdo->prepare($sqlFilme);
            $stmtFilme->execute([':filme_id' => $filme_id]);

            return [
                'success' => true,
                'message' => 'Filme alugado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao alugar: ' . $e->getMessage()
            ];
        }
    }
}