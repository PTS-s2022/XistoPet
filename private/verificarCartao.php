<?php

use app\libs\client\ClientCard;

require_once("../vendor/autoload.php");
require_once("../config.php");



$clientCard = new ClientCard;

session_start();
if(!isset($_SESSION['user']['client'])){
  header("Location: login.php");
}

if(isset($_POST['switch'])){
  $data['switch'] = 'add';
}

if(isset($_GET['card'])){
  $data['switch'] = 'delete';
}

$data['idClient'] = $_SESSION['user']['client'];

switch ($data['switch']) {
  case 'add':

    if($_SERVER['REQUEST_METHOD'] != "POST"){
      die("acesso negado.");
    }
       
    $data['card'] = [
      'number' => $_POST['cardNumber'],
      'name' => $_POST['cardName'],
      'validiti' => $_POST['cardMonth'].'/'.$_POST['cardYear'],
      'cvv' => $_POST['cardCvv']
    ];
    
    $clientCard->insertCard($data);

    break;
  case 'delete':
    $data['card']['cardDisable'] = $_GET['card'];
    $clientCard->deleteCard($data);

    break;
}

if(isset($_SESSION['CONTROLER'])){
  unset($_SESSION['CONTROLER']);
  header('Location: ../public/venda.php');
  die();
}

header('Location: ../public/perfil.php');
