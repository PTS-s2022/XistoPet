<?php

use app\libs\product\ProductStock;

require_once("../vendor/autoload.php");

$productStock = New ProductStock;


session_start();
if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}


foreach ($_POST as $k => $v) {

  if(str_contains($k, 'idProductSize')){
    $i = str_replace('idProductSize', '', $k);

    $size[] = [
      'stock' => $_POST["stock$i"],
      'id' => $_POST["idProductSize$i"]
    ];

  }
}

$data['form'] = [
  'idSupplier' => $_POST['Fornecedor'],
  'size' => $size,
  'idProduct' => $_POST['idProduct']
];

    
$error = $productStock->addStock($data);

if($error){
  $_SESSION['ERROR'] = $error; 
  header('Location: ../public/estoque.php?idProduct='. $data['form']['idProduct']);
  die();
}

header('Location: ../public/produtoGerenciar.php');
