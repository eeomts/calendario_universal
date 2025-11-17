<?php

session_start();


// require_once __DIR__ . '/../models/Main.php';

$main = new Main();
$retorno = $main->GetLogin($_POST);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($retorno);
exit;
