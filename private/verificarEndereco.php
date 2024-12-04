<?php

use app\libs\client\ClientAddress;

require_once("../vendor/autoload.php");
require_once("../config.php");



$clientAddress = new ClientAddress;

session_start();
if(!isset($_SESSION['user']['client'])){
  header("Location: login.php");
}


if(isset($_POST['switch'])){
  $data['switch'] = 'add';
}

if(isset($_GET['address'])){
  $data['switch'] = 'delete';
}

switch ($data['switch']) {
  case 'add':
    if($_SERVER['REQUEST_METHOD'] != "POST"){
      die("acesso negado.");
    }
    
    
    $data['address'] = [
      'cep' => $_POST['cep'],
      'state' => $_POST['estado'],
      'city' => $_POST['cidade'],
      'neighborhood' => $_POST['bairro'],
      'publicPlace' => $_POST['logradouro'],
      'number' => $_POST['numero'],
      'complement' => $_POST['complemento']
    ];
    
    $data['idClient'] = $_SESSION['user']['client'];
    
    if($_POST['idAddress']){
      $data['address']['addressDisable'] = $_POST['idAddress']; 
      $header = '?address='.$_POST['idAddress'];
    }
    
    $error = $clientAddress->insertAddress($data);

    break;
  
  case 'delete':
    $data['idClient'] = $_SESSION['user']['client'];
    $data['address']['addressDisable'] = $_GET['address'];

    $error = $clientAddress->deleteAddress($data);
    
    break;
   
}

if($error){
  $_SESSION['ERROR'] = $error['ERROR']; 
  header('Location: ../public/addEndereco.php'. $header);
  die();
}

if(isset($_SESSION['CONTROLER'])){
  unset($_SESSION['CONTROLER']);
  header('Location: ../public/venda.php');
  die();
}
header('Location: ../public/perfil.php');
?>
