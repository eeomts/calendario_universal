<?php
// Language: PHP
// File: `ajax/post-login.php`

// Resumo: carrega o mesmo `config.php` usado pela index (inicia sessão, autoload, DB, Url),
// instancia Main com tratamento de erro e devolve JSON consistente para o cliente.

header('Content-Type: application/json; charset=utf-8');

try {
    // tenta carregar config.php (ajuste caminho se necessário)
    $config = __DIR__ . '/../config.php';
    if (!is_file($config)) {
        http_response_code(500);
        echo json_encode(['type' => 'error', 'message' => 'Arquivo de configuração não encontrado.']);
        exit;
    }
    require_once $config;

    // garante que a sessão está ativa (config.php já faz isso, é redundante e segura)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // verifica existência da classe Main (autoloader do config deve carregá‑la)
    if (!class_exists('Main')) {
        http_response_code(500);
        echo json_encode(['type' => 'error', 'message' => 'Erro interno: classe Main não encontrada.']);
        exit;
    }

    $main = new Main();
    $retorno = $main->GetLogin($_POST ?? []);
    echo json_encode($retorno);
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'type' => 'error',
        'message' => 'Erro inesperado: ' . $e->getMessage()
    ]);
    exit;
}
