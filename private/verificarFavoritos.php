<?php

use app\libs\client\ClientFavorite;

require_once("../vendor/autoload.php");
require_once("../config.php");



$clientFavorite = new ClientFavorite;

session_start();
if(!isset($_SESSION['user']['client'])){
  header("Location: login.php");
}

$data = [
  'idClient' => $_SESSION['user']['client'],
  'idProduct' => $_GET['product']
];

$clientFavorite->crudFavorite($data);

if(isset($_GET['switch'])){
  header('Location: ../public/perfil.php');
  die();
}

header('Location: ../public/produto.php?idProduct=' . $data['idProduct']);