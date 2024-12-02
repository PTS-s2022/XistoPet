<?php


use app\libs\user\User;

require_once("../vendor/autoload.php");
require_once("../config.php");
require_once ('../bug/phpMailer/phpMailer.php');

$user = new User;

session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

$data['form']['email'] = $_POST['email'];

if(isset($_POST['token'])){
  $data['form']['token'] = $_POST['token'];
}

if(isset($_POST['passwordNew']) && isset($_POST['passwordNewVerify'])){
  $data['form']['passwordNew'] = $_POST['passwordNew'];
  $data['form']['passwordNewVerify'] = $_POST['passwordNewVerify'];
}

$verify = $user->forgotPassword($data);

if($verify){
  if(isset($verify['ERROR'])){
    $_SESSION['ERROR'] = $verify['ERROR'];

  }

  header('Location: '. $verify['location']);
}
