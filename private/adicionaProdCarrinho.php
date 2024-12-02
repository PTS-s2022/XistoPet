<?php

use app\libs\cart\Cart;

require_once("../vendor/autoload.php");

$cart = new Cart;

session_start();


if(!isset($_SESSION['user']['client'])){
  $_SESSION['CONTROL'] = "addProduto";
  if(isset($_POST['op'])){
    $_SESSION['idProduct'] = $_POST['idProduct'];
    $_SESSION['idProductSize'] = $_POST['op'];
    $_SESSION['amount'] = $_POST['amount'];
  }
  header("Location: ../public/login.php");
  die();
}

if(isset($_SESSION['idProductSize']) && isset($_SESSION['amount'])){
  $data = [
    'idProduct' => $_SESSION['idProduct'],
    'idProductSize' => $_SESSION['idProductSize'],
    'amount' => $_SESSION['amount']
  ];

  unset($_SESSION['idProductSize']);
  unset($_SESSION['amount']);
}
else{
  if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("acesso negado.");
  }
}

if(isset($_POST['op']) && isset($_POST['amount'])){
  $data = [
    'idProduct' => $_POST['idProduct'],
    'idProductSize' => $_POST['op'],
    'amount' => $_POST['amount']
  ];

}


$data['idClient'] = $_SESSION['user']['client'];

$addProductCart = $cart->addProductCart($data);
if(isset($addProductCart['ERROR'])){
  $_SESSION['ERROR'] = $addProductCart['ERROR'];
  header("Location: ../public/produto.php?idProduct=". $data['idProduct']);
}


header("Location: ../public/productRelated.php?product=". $data['idProduct']);

?>
</body>
</html>