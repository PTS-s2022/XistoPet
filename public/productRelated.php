<?php

use app\libs\cart\Cart;
use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");
require_once("../config.php");


$cart = new Cart;
$displayProduct = new DisplayProduct;

session_start();

if(!isset($_SESSION['user'])){
  $_SESSION['CONTROL'] = "carrinho";
  header("Location: login.php");
  die();
}

$data = [
  'idProduct' => $_GET['product'],
  'idClient' => $_SESSION['user']['client'],
]; 


$data['product'] = $displayProduct->verifyProduct($data);
if($data['product']){
  header("Location: index.php");
  die();
}
$data['product'] = $displayProduct->dataProduct($data);

$data['product']['image'] = $displayProduct->dataImage($data);

$data = $cart->displayCart($data);
$data['cart']['totalPrice'] = 0;

foreach ($data['cart']['item'] as $k => $item){
  $data['cart']['totalPrice'] += $item['priceSubTotal'];
}

$selectProduct = $displayProduct->selectProducts($data['product']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Produtos relacionados</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/productRelated/relacionados.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/productRelated/relacionados-responsivo.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
</head>
<body onload="Carregado()">

<?php
  require_once('../libs/header.php');
?>

  <div class="tudo">
    <div class="description"> <!-- DIV SOBRE O PRODUTO -->
      <div class="adc-carrinho">
        <img src="../imagem/<?= $data['product']['image'][0] ?>" id="img-produto" class="no-select-img">
        <div class="texto-adc-carrinho">
          <div class="confirmado-adc"><i class='bx bx-cart-add'></i>Adicionado ao carrinho</div>
        </div>
      </div> <!-- IMAGEM DO PRODUTO 1 -->
      <div class="container">
        <div class="content" action="" method="post">
          <p class="subtotal">Subtotal do carrinho: <span class="formatar-preco"><?= $data['cart']['totalPrice'] ?></span></p>
          <div class="container-btn">
          <a class="a-formatado" href="venda.php"><button class="btn-principal btn">Finalizar Pedido (<?= count($data['cart']['item']);?> Produtos)</button></a>
          <a class="a-formatado" href="carrinho.php"><button class="btn-amarelo btn" >Ir para o carrinho</button></a>
          </div>
        </div>
      </div>
    </div> <!-- FIM DA DESCRIÇÃO DO PRODUTO -->
    <div class="container-produtos">
      <div class="produtos-relacionados">
        <?php foreach($selectProduct as $k => $product):?>
          <div class="products"> <!-- PRODUTO -->
            <div class="img-products"><img src="../imagem/<?= $product['image'] ?>" ></div>
            <p class="nome-p"><?= $product['name'] ?></p>
            <div class="preco-flex">
              <p class="preco formatar-preco"><?= $product['price']['min']?></p>
              <p class="traco">-</p>
              <p class="preco formatar-preco"><?= $product['price']['max']?></p>
            </div>
            <a class="btn-adic a-formatado" href="produto.php?idProduct=<?= $product['id']?>"><button class="btn btn-amarelo">Visualizar</button></a>
          </div>
        <?php endforeach;?>  
      </div>

    </div>
  </div>
      
      
  </div> <!-- FIM DA DIV SOBRE O PRODUTO -->

<?php
require_once('../libs/footer.php');
?>

<script src="../assets/js/productRelated/relacionados.js"></script>

</html>