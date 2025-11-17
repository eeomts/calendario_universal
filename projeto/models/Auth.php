<?php
// File: `calendario_universal/projeto/models/Auth.php`
class Auth
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = DB::getInstance();
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public function login($usuario, $senha, $remember = false)
    {
        // aceita login por usuario ou por email
        $sql = "SELECT id, usuario, email, pass_senha, fk_tipo FROM custom_users WHERE usuario = :u OR email = :u LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':u', $usuario);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                "success" => false,
                "message" => "Usuário não encontrado."
            ];
        }

        if (!password_verify($senha, $user['pass_senha'])) {
            return [
                "success" => false,
                "message" => "Senha incorreta."
            ];
        }

        // registra sessão (mesmas chaves usadas em outros pontos do projeto)
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'] ?? $user['email'];
        $_SESSION['usuario_tipo'] = $user['fk_tipo'] ?? null;

        // lembrar login: tenta usar a tabela remember_tokens, se falhar cria cookie fallback
        if ($remember) {
            try {
                $this->createRememberToken((int)$user['id']);
            } catch (Exception $e) {
                // fallback simples (menos seguro): cookie com id do usuário
                setcookie("remember_token", (string)$user['id'], time() + 60 * 60 * 24 * 30, "/");
            }
        }

        return [
            "success" => true,
            "message" => "Logado com sucesso!"
        ];
    }


    private function createRememberToken(int $user_id)
    {
        $token = bin2hex(random_bytes(32));
        $token_hash = hash('sha256', $token);

        $expires_at = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 dias
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO remember_tokens (user_id, token_hash, expires_at, created_at)
                VALUES (:user_id, :token_hash, :expires_at, :created_at)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id'     => $user_id,
            'token_hash'  => $token_hash,
            'expires_at'  => $expires_at,
            'created_at'  => $created_at
        ]);

        setcookie(
            'remember_token',
            $token,
            time() + (86400 * 30),
            '/',
            '',
            isset($_SERVER['HTTPS']), // secure only when HTTPS
            true   // httponly
        );
    }

    public function autoLogin()
    {
        if (isset($_SESSION['usuario_id'])) {
            return true;
        }

        if (!isset($_COOKIE['remember_token'])) {
            return false;
        }

        $token = $_COOKIE['remember_token'];
        $token_hash = hash('sha256', $token);

        $sql = "SELECT * FROM remember_tokens
                WHERE token_hash = :token_hash AND expires_at > NOW()
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token_hash' => $token_hash]);
        $remember = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$remember) {
            $this->logout();
            return false;
        }

        $_SESSION['usuario_id'] = $remember['user_id'];

        return true;
    }

    public function logout()
    {
        if (isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $token_hash = hash('sha256', $token);

            $sql = "DELETE FROM remember_tokens WHERE token_hash = :token_hash";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['token_hash' => $token_hash]);

            setcookie('remember_token', '', time() - 3600, '/');
        }

        session_unset();
        session_destroy();
    }
}
