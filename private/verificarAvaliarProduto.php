<?php

use app\libs\product\ProductComment;

require_once("../vendor/autoload.php");
require_once("../config.php");

$productComment = New ProductComment;


session_start();

if(!isset($_SESSION['user']['client'])){
  header("Location: login.php");
  die();
}

if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

$data['form'] = [
  'assess' => $_POST['assess'],
  'comment' => $_POST['comment'],
  'saleItem' => $_POST['saleItem'],
  'idProduct' => $_POST['product']
];

$data['idClient'] = $_SESSION['user']['client'];

$verifyComment = $productComment->comment($data); 

header("Location: ../public/produto.php?idProduct=". $data['form']['idProduct']);
die();
