<?php

use app\libs\sale\SaleMenager;

require_once("../vendor/autoload.php");
require_once("../config.php");


$sale = new SaleMenager;


session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data = [
  'idAdmin' => $_SESSION['user']['admin'],
  'form' => [
    'idSale' => $_POST['idSale'],
    'switch' => $_POST['switch']
  ]
];

if($data['form']['switch'] == 'update'){
  $data['form']['status'] = $_POST['status'];

  $sale->updateSale($data);
}

if($data['form']['switch'] == 'delete'){
  $sale->deleteSale($data);
  
}


header("Location: ../public/vendaGerenciar.php");
die();