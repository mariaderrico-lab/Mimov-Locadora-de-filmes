<?php
namespace Database;

use PDO;
use PDOException;

class Conexao
{
    private static $instancia = null;

    public static function getConexao()
    {
        if (self::$instancia === null) {
            $host = 'localhost';
            $db   = 'locadora';
            $user = 'root';
            $pass = '1234';
            $port = '3306';

            try {
                self::$instancia = new PDO(
                    "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
