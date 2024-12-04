<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");

$product = New DisplayProduct;


session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data['switch'] = $_POST['switch'];
switch ($data['switch']) {
  case 'add':
    $data['form'] = [
      'name' => $_POST['name'],
      'image' => $_FILES['foto-produto']
    ];
    
    $error = $product->addCategory($data);
    $header = '';
    break;

  case 'alter':
    $data['form'] = [
      'name' => $_POST['name'],
      'idCategory' => $_POST['idCategory'],
      'image' => $_FILES['foto-produto']
    ];

    $error = $product->alterCategory($data);
    $header = '?switch=alter&&idCategory=' . $_POST['idCategory'];
    break;

  case 'delete':
    $data['form'] = [
      'idCategory' => $_POST['idCategory']
    ];

    $product->deleteCategory($data);
    break;
}
if($error){
  $_SESSION['ERROR'] = $error; 
  header('Location: ../public/produtoCategoriaAdd.php'.$header);
  die();
}

header('Location: ../public/produtoGerenciar.php');

