<?php
namespace Controller;
use Model\Usuario;
class AuthController
{
    private $usuarioModel;
    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    private function validateLoginFields(string $email, string $senha): array|null
    {
        if (empty(trim($email)) || empty($senha)) {
            return [
                "success" => false,
                "message" => "Preencha e-mail e senha."
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                "success" => false,
                "message" => "Formato de e-mail inválido."
            ];
        }

        return null;
    }

    public function login(string $email, string $senha): array
    {
        $validationError = $this->validateLoginFields($email, $senha);
        if ($validationError !== null) {
            return $validationError;
        }

        $usuario = $this->usuarioModel->autenticar(trim($email), $senha);

        if ($usuario === null) {
            return [
                "success" => false,
                "message" => "E-mail ou senha incorretos."
            ];
        }

        return [
            "success" => true,
            "message" => "Login realizado com sucesso.",
            "user" => $usuario
        ];
    }

    public function logout(): array
    {
        return [
            "success" => true,
            "message" => "Sessão encerrada com sucesso."
        ];
    }
}