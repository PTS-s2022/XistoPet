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

      break;
    
    case 'alter':
      foreach ($_POST as $k => $v) {

        if(str_contains($k, 'idImage')){
          $idImage[] = $v;
    
        }
      }
      $data['form']['idImage'] = $idImage;
      $data['form']['idProduct'] = $_POST['idProduct'];
      $product->alterProduct($data);
      break;
  }
}


header('Location: ../public/produtoGerenciar.php');
