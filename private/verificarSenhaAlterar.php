<?php

use app\libs\user\User;

require_once("../vendor/autoload.php");
require_once("../config.php");
require_once("..\bug\phpMailer\phpMailer.php");

$user = new User;


session_start();
if(!isset($_SESSION['user'])){
  header("Location: ../public/login.php");
}

if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

$data = [
  'idUser' => $_SESSION['user']['id'],
  'email' => $_SESSION['user']['email'],
  'form' => [
    'password' => $_POST['password'],
    'passwordNew' => $_POST['passwordNew'],
    'passwordNewVerify' => $_POST['passwordNewVerify']
  ]
];


$verify = $user->alterPassword($data);

if($verify){
  $_SESSION['ERROR'] = $verify;
  header("Location: ../public/senhaAlterar.php");
  die();
}

header("Location: ../public/perfil.php"); 