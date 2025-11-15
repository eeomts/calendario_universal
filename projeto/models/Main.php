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


//    public function getDb() {
//        return $this->db;
//    }
//
//
//    public function getUsers() {
//        $sql = "SELECT * FROM usuarios";
//        $this->db->executeSql($sql);
//        return $this->db->fetchAll("arr"); // retorna array associativo
//    }
//
//
//    public function addUser($nome, $email) {
//        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
//        $this->db->setValue([
//            ["var" => ":nome", "value" => $nome, "parametro" => "str"],
//            ["var" => ":email", "value" => $email, "parametro" => "str"]
//        ]);
//        $this->db->executeSql($sql);
//        return $this->db->lastId();
//    }

//    public function ValLogin($post)
//    {
//        $data_atual = date('Y-m-d H:i:s');
//        $senha = md5($post['pass_senha']);
//
//        $db = $this->db;
//        $db->executeSql(
//            "SELECT * FROM usuarios WHERE usuarios.email = '{$post['email']}' AND usuarios.pass_senha = '$senha' "
//        );)
//    }


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
                    "message" => "Já existe uma conta com esse e-mail.",
                    "url" => "login",
                    "time" => 2500
                ];
            }

            // --- Inserção ---
            $nome       = trim($post['nome']);
            $sobrenome  = trim($post['sobrenome']);
            $senha      = password_hash($post['senha'], PASSWORD_DEFAULT);
            $token      = bin2hex(random_bytes(16));
            $data       = date("Y-m-d H:i:s");

            $sql = "
            INSERT INTO custom_users (nome, sobrenome, email, pass_senha, token, created)
            VALUES (?, ?, ?, ?, ?, ?)
        ";

            $db->executeSql($sql, [$nome, $sobrenome, $email, $senha, $token, $data]);

            return [
                "type" => "success",
                "message" => "Cadastro realizado com sucesso!",
                "url" => "cadastro",
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
}