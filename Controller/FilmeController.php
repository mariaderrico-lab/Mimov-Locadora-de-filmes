<?php

namespace Controller;
use Database\Conexao;
use PDO;
class FilmeController {
    
    public function getCatalog() {
        try {
            $pdo = Conexao::getConexao();
            $stmt = $pdo->query("SELECT id, titulo, genero, ano, preco, quantidade_disponivel FROM filmes");
            $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'success' => true,
                'response' => [
                    'data' => $filmes
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => [
                    'data' => []
                ],
                'message' => 'Erro ao buscar catálogo: ' . $e->getMessage()
            ];
        }
    }

    public function store($dados) {
        $titulo = $dados['titulo'] ?? '';
        $genero = $dados['genero'] ?? '';
        $ano = $dados['ano'] ?? '';
        $preco = $dados['preco'] ?? '';
        $quantidade = $dados['quantidade'] ?? 1;

        if (empty($titulo) || empty($genero) || empty($ano) || empty($preco)) {
            return [
                'success' => false,
                'message' => 'Preencha todos os campos obrigatórios para cadastrar o filme.'
            ];
        }

        try {
            $pdo = Conexao::getConexao();
            $sql = "INSERT INTO filmes (titulo, genero, ano, preco, quantidade_total, quantidade_disponivel) 
                    VALUES (:titulo, :genero, :ano, :preco, :qtd, :qtd)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':genero' => $genero,
                ':ano' => $ano,
                ':preco' => $preco,
                ':qtd' => $quantidade
            ]);

            return [
                'success' => true,
                'message' => 'Filme cadastrado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao cadastrar filme: ' . $e->getMessage()
            ];
        }
    }
}