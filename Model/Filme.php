<?php
namespace Model;
use Database\Conexao;
use PDO;

class Filme
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Conexao::getConexao();
    }
    public function listar(bool $apenasDisponiveis = false): array
    {
        $sql = "SELECT * FROM filmes";
        if ($apenasDisponiveis) {
            $sql .= " WHERE quantidade_disponivel > 0";
        }
        $sql .= " ORDER BY id DESC"
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM filmes WHERE id = :id"
        );

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $filme = $stmt->fetch(PDO::FETCH_ASSOC);
        return $filme ?: null;
    }

    public function cadastrar(
        string $titulo,
        string $genero,
        int $ano,
        float $preco,
        ?string $imagem = null
    ): bool {

        $sql = "INSERT INTO filmes
                (titulo, genero, ano, preco, imagem, quantidade_total, quantidade_disponivel)
                VALUES
                (:titulo, :genero, :ano, :preco, :imagem, 1, 1)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':genero', $genero);
        $stmt->bindValue(':ano', $ano, PDO::PARAM_INT);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':imagem', $imagem);
        return $stmt->execute();
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM filmes WHERE id = :id"
        );

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
