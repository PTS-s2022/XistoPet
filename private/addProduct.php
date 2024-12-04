<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");

$product = New DisplayProduct;


session_start();
if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

$data['switch'] = $_POST['switch'];

if($data['switch'] == 'delete'){
  $data['form']['idProduct'] = $_POST['idProduct'];

  $product->deleteProduct($data);
}
else{
  
  foreach ($_POST as $k => $v) {

    if(str_contains($k, 'tamanho')){
      $i = str_replace('tamanho', '', $k);

      $size[] = [
        'size' => $v,
        'price' => $_POST["preco$i"],
        'id' => $_POST["idSize$i"]
      ];

    }
  }

  $data['form'] = [
    'name' => $_POST['name'],
    'description' => $_POST['descricao'],
    'category' => $_POST['categoria'],
    'size' => $size,
    'image' => $_FILES
  ];

  switch ($data['switch']) {
    case 'add':
      
      $error = $product->addProduct($data);
      $header = 'produtoAdd.php';
      $controler = 1;
      break;
    
    case 'alter':
      foreach ($_POST as $k => $v) {

        if(str_contains($k, 'idImage')){
          $idImage[] = $v;
    
        }
      }
      $data['form']['idImage'] = $idImage;
      $data['form']['idProduct'] = $_POST['idProduct'];
      $error = $product->alterProduct($data);
      $header = 'produtoAlterar.php?idProduct='.$_POST['idProduct'];
      break;
  }
}
if(isset($error['idProduct'])){
  header('Location: ../public/estoque.php?idProduct='.$error['idProduct']);
  die();
}
if($error){
  $_SESSION['ERROR'] = $error; 
  header('Location: ../public/'.$header);
  die();
}

header('Location: ../'.$header);
