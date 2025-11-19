<?php

// File: `calendario_universal/projeto/index.php`
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/rememberAuth.php';

// $url já criado em config.php
$logado = isset($_SESSION['usuario_id']);
$base = rtrim($url->base(), '/') . '/';
$pagina0 = $url->segment(0, null);
$pagina1 = $url->segment(1, null);

if ($pagina0 === null || $pagina0 === '') {
    $pagina0 = $logado ? 'home' : 'login';
}

$publicRoutes = ['login', 'cadastro', 'ajax'];
if (!$logado && !in_array($pagina0, $publicRoutes, true)) {
    header('Location: ' . $base . 'login');
    exit;
}

if ($logado && in_array($pagina0, ['login', 'cadastro'], true)) {
    header('Location: ' . $base . 'home');
    exit;
}

if ($pagina0 === 'ajax') {
    header('Content-Type: application/json; charset=utf-8');
    if ($pagina1) {
        $ajaxFile = __DIR__ . "/ajax/{$pagina1}.php";
        if (is_file($ajaxFile)) {
            include $ajaxFile;
        } else {
            http_response_code(404);
            echo json_encode(['type' => 'error', 'message' => 'Recurso ajax não encontrado.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['type' => 'error', 'message' => 'Ação ajax não informada.']);
    }
    exit;
}

// render
ob_start();
switch ($pagina0) {
    case 'cadastro':
        include __DIR__ . '/views/cadastro.inc.php';
        break;
    case 'login':
        include __DIR__ . '/views/login.inc.php';
        break;
    case 'home':
        $homeFile = __DIR__ . '/views/home.inc.php';
        if (is_file($homeFile)) include $homeFile;
        else echo "<h1>Página Home</h1><p>Bem-vindo.</p>";
        break;
    default:
        $file = __DIR__ . "/{$pagina0}.php";
        if (is_file($file)) include $file;
        else { http_response_code(404); echo "<h1>404 - Página não encontrada</h1>"; }
        break;
}
$content = ob_get_clean();
?>


<!DOCTYPE html>
<html lang="BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Calendário Universal</title>
<base href="<?= $url->base(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<meta name="ajax-path" content="<?= $url->getBase(); ?>">
<meta name="ajax-full-path" content="<?= $url->getBase(); ?>">
<base href="<?= $url->getBase(); ?>">
<!--<meta name="ajax-path" content="--><?php //= $url->getBase(); ?><!--">-->

<!--<meta name="ajax-full-path" content="--><?php //= $url->getBase(); ?><!--">-->




    <link rel="stylesheet" href="assets/css/style.css?<?= time() ?>">

<link href="<?= $url->getBase(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->getBase(); ?>assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->getBase(); ?>assets/libs/jqueryconfirm/css/jquery-confirm.css" rel="stylesheet"
<link href="<?= $url->base(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

<link href="<?= $url->base(); ?>assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->base(); ?>assets/libs/jqueryconfirm/css/jquery-confirm.css" rel="stylesheet"
      type="text/css"/>


<!--assets calendario !!!!-->

<!--    <link rel="stylesheet" href="assets/css/global_css_calendario.css?--><?php //= time() ?><!--">-->
<!--    <link rel="stylesheet" href="assets/js/global_mainjs_calendario?--><?php //= time()?><!--">-->
<!--    <link rel="stylesheet" href="assets/css/style_css_calendario.css?--><?php //= time() ?><!--">-->
</head>

<body>

<?= $content ?>

<!-- scripts -->
<!-- jQuery -->
<script src="<?= $url->base(); ?>assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>
<!-- Bootstrap Bundle JS -->
<script src="<?= $url->base(); ?>assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<!-- Feather Icon JS -->
<script src="<?= $url->base(); ?>assets/js/feather.min.js" type="text/javascript"></script>
<!-- Datatables JS -->
<script src="<?= $url->base(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<!-- Custom JS -->
<script src="<?= $url->base(); ?>assets/js/script.js" type="text/javascript"></script>
<!-- Owl Carousel -->
<script src="assets/js/owl.carousel.min.js" type="text/javascript"></script>
<!-- counterup JS -->
<script src="assets/js/jquery.waypoints.js" type="text/javascript"></script>
<script src="assets/js/jquery.counterup.min.js" type="text/javascript"></script>
<!-- Aos -->
<script src="assets/plugins/aos/aos.js" type="text/javascript"></script>
<!-- Select2 JS -->
<script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Slick JS -->
<script src="assets/js/slick.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/mootools-core-1.4.5.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/classes/default.js"></script>
<!--<script src="--><?php //= $url->getBase(); ?><!--assets/js/classes/ajax.js"></script>-->
<script src="<?= $url->base(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/jqueryconfirm/js/jquery-confirm.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/mascara.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/main.js?<?= time() ?>" type="text/javascript"></script>

</body>
</htm