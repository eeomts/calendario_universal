<?php
include('../config.php');
extract($_POST);
$ip = $_SERVER['REMOTE_ADDR'];
$data = date('d/m/Y - H:i');
$Main = new Main();
$login = $Main->login($email, $senha);