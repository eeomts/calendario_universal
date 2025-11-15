<?php


include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//class
$url = new RealURL();
$MainClass = new Main();
$pagina0 = $url->segment(0);
$pagina1 = $url->segment(1);
$pagina2 = $url->segment(2);


if ($pagina0 == 'ajax') {
    include("ajax/{$pagina1}.php");
    exit;
}

//echo BASE_DIR;

//functions
//$users = $MainClass->getUsuarios();
//echo "<pre>";
//var_dump($users);


?>

<!DOCTYPE html>
<html lang="BR">
<head>
    <base href="<?= $url->base(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<!--<meta name="ajax-path" content="--><?php //= $url->getBase(); ?><!--">-->

<!--<meta name="ajax-full-path" content="--><?php //= $url->getBase(); ?><!--">-->




<!--    <link rel="stylesheet" href="assets/css/style.css?--><?php //= time() ?><!--">-->

<link href="<?= $url->base(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

<link href="<?= $url->base(); ?>assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->base(); ?>assets/libs/jqueryconfirm/css/jquery-confirm.css" rel="stylesheet"
      type="text/css"/>



</head>
<body>
<?php include "views/cadastro.inc.php"; ?>

<?php echo $url->base()?>

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
<script src="<?= $url->base(); ?>assets/libs/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/libs/jqueryconfirm/js/jquery-confirm.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/mascara.js" type="text/javascript"></script>
<script src="<?= $url->base(); ?>assets/js/main.js?<?= time() ?>" type="text/javascript"></script>

</body>
</html>
