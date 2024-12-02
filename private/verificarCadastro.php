<?php

require_once("../vendor/autoload.php");
require_once("../config.php");

use app\libs\authenticate\Register;

$register = new Register();

session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

//Definindo variaveis
$data = [
  'nome' => $_POST['nome'],
  'email' => $_POST['email'],
  'senha' => $_POST['senha'],
  'senhaRep' => $_POST['senhaRep'],
  'sub' => NULL,
  'response' => $_POST['g-recaptcha-response'],
];

//verificando dados
$verifyData = $register->verifyData($data);
if($verifyData != false){
  $_SESSION['ERROR'] = $verifyData;
  header("Location: ../public/cadastro.php");
  die();
}

//encriptando a senha
$data['senha'] = $register->encryptPass($data['senha']);

//registando user e client
$register->register($data);

header("Location: ../public/login.php")
?>

</body>
</html>