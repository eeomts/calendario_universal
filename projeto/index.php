<?php
include('config.php');

//class
$url = new Url();
$MainClass = new Main();
$pagina = $url->getURL(0);

//echo BASE_DIR;

//functions
//$users = $MainClass->getUsuarios();
//echo "<pre>";
//var_dump($users);


?>

<!DOCTYPE html>
<html lang="BR">
<head>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<meta name="ajax-path" content="<?= $url->getBase(); ?>">
<meta name="ajax-full-path" content="<?= $url->getBase(); ?>">
<base href="<?= $url->getBase(); ?>">

<!--    <link rel="stylesheet" href="assets/css/style.css?--><?php //= time() ?><!--">-->

<link href="<?= $url->getBase(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->getBase(); ?>assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $url->getBase(); ?>assets/libs/jqueryconfirm/css/jquery-confirm.css" rel="stylesheet"
      type="text/css"/>

</head>
<?php

include "views/cadastro.inc.php";
?>

<!-- jQuery -->
<script src="<?= $url->getBase(); ?>assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>
<!-- Bootstrap Bundle JS -->
<script src="<?= $url->getBase(); ?>assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<!-- Feather Icon JS -->
<script src="<?= $url->getBase(); ?>assets/js/feather.min.js" type="text/javascript"></script>
<!-- Datatables JS -->
<script src="<?= $url->getBase(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<!-- Custom JS -->
<script src="<?= $url->getBase(); ?>assets/js/script.js" type="text/javascript"></script>
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
<script src="<?= $url->getBase(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/js/mootools-core-1.4.5.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/libs/toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/js/classes/default.js"></script>
<script src="<?= $url->getBase(); ?>assets/js/classes/ajax.js"></script>
<script src="<?= $url->getBase(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/libs/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/libs/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/libs/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/libs/jqueryconfirm/js/jquery-confirm.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/js/mascara.js" type="text/javascript"></script>
<script src="<?= $url->getBase(); ?>assets/js/main.js?<?= time() ?>" type="text/javascript"></script>

</body>


</html>
