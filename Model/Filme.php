<?php
namespace Model;
use PDO;
use PDOException;

class Filme
{
    private $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'locadora';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function listar(bool $apenasDisponiveis = false): array
    {
        $sql = "SELECT * FROM filmes";
        if ($apenasDisponiveis) {
            $sql .= " WHERE disponivel = 1";
        }
        $sql .= " ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM filmes WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $filme = $stmt->fetch(PDO::FETCH_ASSOC);
        return $filme ?: null;
    }

    public function cadastrar(string $titulo, string $genero, int $ano, float $preco, ?string $imagem = null): bool
    {
        $sql = "INSERT INTO filmes (titulo, genero, ano, preco, imagem, disponivel) 
                VALUES (:titulo, :genero, :ano, :preco, :imagem, 1)";

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
        $stmt = $this->pdo->prepare("DELETE FROM filmes WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}