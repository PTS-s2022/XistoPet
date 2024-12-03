<?php

use app\libs\supplier\Supplier;

require_once("../vendor/autoload.php");
require_once("../config.php");


$supplier = new Supplier;

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
      'cnpj' => $_POST['cnpj'],
      'number' => $_POST['telephone']
    ];

    $error = $supplier->addSupplier($data);

    break;
  case 'delete':
    $data['form'] = [
      'idSupplier' => $_POST['idSupplier']
    ];

    $error = $supplier->deleteSupplier($data);

    break;
  default:
    # code...
    break;
}
if($error){
  $_SESSION['ERROR'] = $error; 
}

header('Location: ../public/fornecedorGerenciar.php');