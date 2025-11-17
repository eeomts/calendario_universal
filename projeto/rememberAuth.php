<?php // remember_auth.php

// já carregou o config na index, então NÃO carrega de novo

$auth = new Auth();
$auth->autoLogin();