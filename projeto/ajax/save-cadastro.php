<?php
include('../config.php');
extract($_POST);

$Main = new Main();

$save_cadastro = $Main->insertCadastro($_POST);

$nome = $_POST['nome'] ?? [];

$email = $_POST['email'] ?? [];

$url = "views/login";

// Retorno JSON
$retorno = array(
    'response' => "Solicitaçao realizada com sucesso!",
    'type' => 'success',
    "redir" => "{$url}"
);

echo json_encode($retorno);