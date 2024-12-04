<?php

use app\libs\sale\Sale;

require_once("../vendor/autoload.php");
require_once("../config.php");


$sale = new Sale;


session_start();

if(!isset($_SESSION['user']['client'])){
  $_SESSION['CONTROL'] = "carrinho";
  header("Location: login.php");
  die();
}


$data['idClient'] = $_SESSION['user']['client'];

foreach ($_POST as $k => $sla) {
  $data['form'][$k] = $sla;
}

$finishSale = $sale->finishSale($data);

if(isset($finishSale['switch'])){
  var_dump($finishSale['switch']);
  header("Location: ../public/". $finishSale['location']);
  die();
}
if($finishSale['ERROR']){
  $_SESSION['ERROR'] = $finishSale['ERROR']; 
  header('Location: ../public/venda.php');
  die();
}


// header("Location: ../public/venda.php");
die();

