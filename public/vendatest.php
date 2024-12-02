<?php

use app\libs\sale\Sale;

require_once("../vendor/autoload.php");
require_once("../config.php");


$sale = new Sale;


session_start();

if(!isset($_SESSION['user'])){
  $_SESSION['CONTROL'] = "carrinho";
  header("Location: login.php");
  die();
}


$data['idClient'] = $_SESSION['user']['client'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
session_start();
require_once("../libs/config.php");

if(!isset($_SESSION['user'])){
  header("Location: login.php");
}


$switch = $_GET['switch']; 
if($venda['endereco'] != null){
  $switch = 'cpf';
  
  if($pessoa['cpf'] != null){
    $switch = 'metodoPagamento';
    
    if($venda['metodo'] != null){
      $switch = 'finalizarCompra';
    }
  }
}



switch ($switch) {
  case 'endereco':
    //selecionando o id do carrinho
    $enderecoPessoa = $bd->prepare("SELECT * FROM tb_endereco_pessoa WHERE pessoa = :pessoa");
    $enderecoPessoa->execute(
      [
        ":pessoa" => $pessoa['id'],
      ]
    );
    $enderecoPessoa = $enderecoPessoa->fetchAll();
    ?>

    <form action="../private/verificarVenda.php" method="POST">
    <input type="hidden" name="endereco">
    <?php foreach ($enderecoPessoa as $key) :?>
      
      <label for="endereco">
        <input type="radio" name="endereco" id="endereco" value="<?= $key['id']?>">
        <?= $key['nome']?><br>
      </label>
    <?php endforeach;?> <br>
    <a href="endereco.php">+ endereço</a><br>
    <input type="submit" value="Continuar">
    </form>
    <?php
    break;
  



  case 'cpf':
    ?>
    <form action="../private/verificarVenda.php" method="POST">
      <input type="hidden" name="cpf">  
      cpf<br>
      <input type="text" name="cpf" id="cpf">
      <input type="submit" value="Continuar">
     
    </form>
    <?php
    break;




  case 'metodoPagamento':
    ?>
    <form action="../private/verificarVenda.php" method="POST">
      <input type="hidden" name="metodoPagamento">
      <?php foreach ($metodosPagamento  as $metodoPagamento) :?>
        <input type="radio" name="metodoPagamento" id="metodoPagamento" value="<?= $metodoPagamento['id']?>"> <?= $metodoPagamento['metodo']?> <br>   
      <?php endforeach;?> <br>
      <input type="submit" value="Continuar">
    </form>
    <?php
    break;




  case 'finalizarCompra':
    ?>
    <form action="../private/verificarVenda.php" method="POST">
      <input type="hidden" name="finalizarCompra">
      <?php foreach ($itensVenda as $itemVenda) :?>
        <td>   
          <?php 
            $produto = $bd->prepare("SELECT nome FROM tb_produto  WHERE id = :produto");
            $produto->execute(
              [
                ":produto" => $itemVenda['produto'],
              ]
            );
            $produto = $produto->fetch();
          ?>

          <b><?= $produto['nome']?></b></br>
          Quantidade:<?= $itemVenda['qtd']?><br>
          Preço:   R$<?= $itemVenda['subTotal']?><br>

        </td> <br><br>
        <?php $total += $itemVenda['subTotal']; ?>
      <?php endforeach;?>
      <b>Total: R$<?= $total?></b><br>
      <input type="submit" value="Continuar">
    </form>
    <?php
    break;
  default:
    # code...
    break;
}
?>
</body>
</html>