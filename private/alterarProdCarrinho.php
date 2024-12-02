<?php

use app\libs\cart\Cart;

require_once("../vendor/autoload.php");

$cart = new Cart;

session_start();

$data = [
  'idClient' => $_SESSION['user']['client'],
  'op' => $_GET['op'],
  'amount' => 1
];

if(isset($_GET['idProductSize'])){
 $data['idProductSize'] = $_GET['idProductSize'];
}


switch ($data['op']) {
  case 'delete':
    $deleteProductCart = $cart->deleteProductCart($data);    
    header("Location: ../public/carrinho.php");

    break;
  case 'add':
    $data['op'] = null;
    $addProductCart = $cart->addProductCart($data);
    if(isset($addProductCart['ERROR'])){
      $_SESSION['ERROR'] = $addProductCart['ERROR'];
    }
    header("Location: ../public/carrinho.php");

    break;
  case 'remove':
    $addProductCart = $cart->addProductCart($data);
    if(isset($addProductCart['ERROR'])){
      $_SESSION['ERROR'] = $addProductCart['ERROR'];
    }
    header("Location: ../public/carrinho.php");

    break;
  case 'deleteItemAll':
    $deleteProductCart = $cart->deleteProductCartAll($data);    
    header("Location: ../public/carrinho.php");

    break;
  default:
    header("Location: ../public/carrinho.php");
    break;
}
?>

</body>
</html>