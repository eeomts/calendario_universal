<?php


include('../config.php');

if (ob_get_length()) {
    ob_clean();
}
header("Content-Type: application/json; charset=utf-8");


$Main = new Main();

$retorno = $Main->insertCadastro($_POST);

echo json_encode($retorno);


