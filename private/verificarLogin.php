<?php

use app\libs\authenticate\Login;

require_once("../vendor/autoload.php");
require_once("../config.php");

$login = new Login;

session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}


//Definindo variaveis
$data = [
  'email' => $_POST['email'],
  'senha' => $_POST['senha'],
  'response' => $_POST['g-recaptcha-response']
];


//verificando dados
$verifyData = $login->verifyData($data);
if($verifyData != false){
  $_SESSION['ERROR'] = $verifyData;
  header("Location: ../public/login.php");
  die();
}

//realiza o login
$login->auth($data);


