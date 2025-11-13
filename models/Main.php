<?php

class Main
{
    private $db;

    public function __construct() {
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




}