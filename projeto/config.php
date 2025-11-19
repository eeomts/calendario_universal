<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('memory_limit', '256M');
set_time_limit(8000);

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR.UTF8');
mb_internal_encoding('UTF8');
mb_regex_encoding('UTF8');

//////INICIO DA SESSAO//////
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


define("PDO_HOST", "localhost");
define("PDO_USER", "root");
define("PDO_DB", "calendario_ufu1");
define("PDO_PASS", "");

define("PDO_DRIVER", "mysql");
define("PDO_PORT", "3306");

define("PATH", "PHP-PESSOAL/PESSOAL/www/calendario_ufu/calendario_universal/projeto/");
define("PATH_UPLOAD", "");



define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', dirname( __FILE__ ) . DS);



// === CORS ===
function enableCORS()
{
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
    return true;
}

enableCORS();

#Auto load class
spl_autoload_register(function ($class) {
    $path = BASE_DIR."models/{$class}.php";
    include $path;
});


$db = new Db();
$url = new Url();
$pagina0 = $url->segment(0);
$pagina1 = $url->segment(1);
$pagina2 = $url->segment(2);


// inicializa $url
if (!isset($url) || !is_object($url)) {
    if (file_exists(__DIR__ . '/models/Url.php')) {
        require_once __DIR__ . '/models/Url.php';
    }

    if (class_exists('Url')) {
        $url = Url::getInstance();
    } else {
        // fallback mínimo compatível com chamadas base() / getBase() / segment()
        $url = new class {
            private $baseUrl;
            private $segments = [];

            public function __construct()
            {
                $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                $root = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
                $this->baseUrl = "{$scheme}://{$host}{$root}";

                if (!empty($_GET['url'])) {
                    $path = (string)$_GET['url'];
                } else {
                    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
                    $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
                    if ($basePath !== '') {
                        $requestPath = preg_replace('#^' . preg_quote($basePath) . '#', '', $requestPath);
                    }
                    $path = trim($requestPath, '/');
                }
                $this->segments = array_values(array_filter(explode('/', $path)));
            }

            public function base()
            {
                return $this->baseUrl;
            }

            public function getBase()
            {
                return $this->base();
            }

            public function segment($i, $default = null)
            {
                return $this->segments[$i] ?? $default;
            }

            public function getSegments()
            {
                return $this->segments;
            }
        };
    }
}








function isOnPage($page)
{
    $url = new Url();
    $pagina = $url->getURL(0);
    return ($pagina == $page) ? " class=\"active\"" : null;
}




