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

        $data_atual = date('Y-m-d H:i:s');
        $db = $this->db;
        $token = md5($post['email']);
        $db->executeSql("SELECT * FROM custom_users WHERE custom_users.email = '{$post['email']}'");
        $valida_usuario = $db->fetchAll();


        if (count($valida_usuario) >= 1) {
            $retorno = array('message' => 'Ja existe um usuário com esse email', 'type' => 'error');
        } else {

            $senha = md5($post['senha']);

            $db->executeSql("INSERT INTO custom_users (nome, created, email, pass_senha, token, )
                 VALUES ('{$post['nome']}',
                         '{$data_atual}',
                         '{$post['email']}',
                         '$senha',
                         '$token',
                         )
                         ");


            $retorno = array('message' => 'Cadastro realizado com sucesso', 'type' => 'success', 'url' => 'login');
        }

        return $retorno;
    }
}