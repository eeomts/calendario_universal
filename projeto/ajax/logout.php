<?php

// File: `ajax/logout.php`
header('Content-Type: application/json; charset=utf-8');

try {
    $config = __DIR__ . '/../config.php';
    if (!is_file($config)) {
        http_response_code(500);
        echo json_encode(['type' => 'error', 'message' => 'Arquivo de configuração não encontrado.']);
        exit;
    }
    require_once $config;
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!class_exists('Auth')) {
        http_response_code(500);
        echo json_encode(['type' => 'error', 'message' => 'Classe Auth não encontrada.']);
        exit;
    }

    $auth = new Auth();
    $auth->logout();

    echo json_encode(['type' => 'success', 'message' => 'Logout efetuado com sucesso.']);
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['type' => 'error', 'message' => 'Erro inesperado: ' . $e->getMessage()]);
    exit;
}
