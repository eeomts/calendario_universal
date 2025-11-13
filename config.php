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


define("PDO_HOST", "localhost");
define("PDO_USER", "root");
define("PDO_DB", "calendario_ufu");
define("PDO_PASS", "");

define("PDO_DRIVER", "mysql");
define("PDO_PORT", "3306");

define("PATH", "PHP-PESSOAL/PESSOAL/www/");
define("PATH_UPLOAD", "");
define("BASE_URL", "http://localhost/OrdoX/projeto/");

define('DS', DIRECTORY_SEPARATOR );
define('BASE_DIR', dirname( __FILE__ ) . DS);

    // === CORS ===
    function enableCORS() {
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


spl_autoload_register(function ($class) {
         $path = BASE_DIR."src/models/{$class}.php";
    include $path;
});


$db = new Db();
$url = new Url();
$pagina = $url->getURL(0);

    function isOnPage($page) {
        $url = new Url();
        $pagina = $url->getURL(0);
        return ($pagina == $page) ? " class=\"active\"" : null;
    }

