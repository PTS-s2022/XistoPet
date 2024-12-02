<?php
session_start();
if($_SERVER['REQUEST_METHOD'] != "GET"){
    die("acesso negado.");
}

use app\libs\authenticate\Login;
use app\libs\authenticate\GoogleClient;

require_once ('../vendor/autoload.php');
require_once("../config.php");

$googleClient = new GoogleClient;
$googleClient->init();
$login = new Login;
if ($googleClient->authorized()) {
    $login->authGoogle($googleClient->getData());
}
