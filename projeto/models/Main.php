<?php


class Main
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = DB::getInstance();
        } catch (PDOException $e) {
            // Trata erro de conexão
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public function insertCadastro($post)
    {
        $db = $this->db;

        try {

            // --- Validação do nome ---
            if (empty($post['nome']) || strlen(trim($post['nome'])) < 2) {
                return [
                    "type" => "error",
                    "message" => "O nome é obrigatório e deve ter ao menos 2 caracteres.",
                    "time" => 2500
                ];
            }

            // --- Validação do sobrenome ---
            if (empty($post['sobrenome']) || strlen(trim($post['sobrenome'])) < 2) {
                return [
                    "type" => "error",
                    "message" => "O sobrenome é obrigatório e deve ter ao menos 2 caracteres.",
                    "time" => 2500
                ];
            }

            // --- Validação do e-mail ---
            if (empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                return [
                    "type" => "error",
                    "message" => "E-mail inválido.",
                    "time" => 2500
                ];
            }

            // --- Validação da senha ---
            if (empty($post['senha']) || strlen($post['senha']) < 6) {
                return [
                    "type" => "error",
                    "message" => "A senha deve ter no mínimo 6 caracteres.",
                    "time" => 2500
                ];
            }

            // --- Confirmação da senha ---
            if (empty($post['confirmPassword']) || $post['senha'] !== $post['confirmPassword']) {
                return [
                    "type" => "error",
                    "message" => "As senhas não conferem.",
                    "time" => 2500
                ];
            }

            // --- Checkbox termos ---
            if (empty($post['terms'])) {
                return [
                    "type" => "error",
                    "message" => "Você deve aceitar os termos de uso e a política de privacidade.",
                    "time" => 2500
                ];
            }

            // --- Checa se email existe ---
            $email = $post['email'];
            $sql = "SELECT id FROM custom_users WHERE email = ?";
            $db->executeSql($sql, [$email]);
            $existe = $db->fetchAll();

            if ($existe) {
                return [
                    "type" => "warning",
                    "message" => "Já existe uma conta com esse e-mail. Se ja possuir uma conta faça login aqui: <a href='login'>LOGIN</a> ou entre em contado com os administradores",
                    "time" => 4000
                ];
            }


            $cpf = $post['cpf'];
            $sql = "SELECT id FROM custom_users WHERE cpf = ?";
            $db->executeSql($sql, [$cpf]);
            $existe = $db->fetchAll();
            if($existe){
                return [
                    "type" => "warning",
                    "message" => "Já existe um cadastro com esse CPF",
                    "time" => 3000
                ];
            }

            // --- Inserção ---
            $nome = trim($post['nome']);
            $sobrenome = trim($post['sobrenome']);
            $senha = password_hash($post['senha'], PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(16));
            $data = date("Y-m-d H:i:s");
            $fk_tipo_user = 1;
            $cpf = trim($post['cpf']);
            $usuario = strstr($email, '@', true);
            $sql = "
            INSERT INTO custom_users (nome, sobrenome, email, pass_senha, token, created, fk_tipo, cpf, usuario)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

            $db->executeSql($sql, [$nome, $sobrenome, $email, $senha, $token, $data, $fk_tipo_user, $cpf, $usuario]);

            return [
                "type" => "success",
                "message" => "Cadastro realizado com sucesso!",
                "url" => "home",
                "time" => 2500
            ];

        } catch (PDOException $e) {
            return [
                "type" => "error",
                "message" => "Erro no banco de dados: " . $e->getMessage(),
                "url" => "404",
                "time" => 2500
            ];
        } catch (Exception $e) {
            return [
                "type" => "error",
                "message" => "Erro inesperado: " . $e->getMessage(),
                "url" => "404",
                "time" => 2500
            ];
        }
    }

    public function GetLogin($post)
    {
        try {

            if (empty($post['usuario'])) {
                return [
                    "type" => "error",
                    "message" => "O usuário é obrigatório.",
                    "time" => 2500
                ];
            }

            if (empty($post['senha'])) {
                return [
                    "type" => "error",
                    "message" => "A senha é obrigatória.",
                    "time" => 2500
                ];
            }

            $remember = isset($post['lembrar']);

            // agora sim: verifica existência
            $auth = new Auth();
            $login = $auth->login(
                $post['usuario'],
                $post['senha'],
                $remember
            );

            if (!$login['success']) {
                return [
                    "type" => "error",
                    "message" => $login['message'],
                    "time" => 2500
                ];
            }

            return [
                "type" => "success",
                "message" => "Login efetuado com sucesso!",
                "url" => "home",
                "time" => 2000
            ];

        } catch (Exception $e) {
            return [
                "type" => "error",
                "message" => "Erro inesperado: " . $e->getMessage(),
                "time" => 3000
            ];
        }
    }

    public function showdays(){

    }
}