<?php

use app\libs\sale\SaleMenager;

require_once("../vendor/autoload.php");
require_once("../config.php");



$saleMenager = new SaleMenager;

session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: login.php");
  die();
}

$data['sales'] = $saleMenager->displaySale();
// echo $sale['status'];
// var_dump($data['sales']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>
    <link rel="stylesheet" href="..\assets\css\saleManager\gestao_pedidos.css">
    <link rel="stylesheet" href="..\assets\css\saleManager\gestao_pedidos_responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="Carregado()">
<?php
  require_once('../libs/header.php');
?> 
  <p class="titulo1"><span>Gerenciar Pedidos</span></p> 
  <div class="container-alto">
    <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
        <div class="card1">
          <div class="responsivo">
            <p class="titulo"><span>Pedidos</span></p>
            <i class='bx bx-menu' id="burguer"></i> <!-- BOTÃO MENU RESPONSIVO -->
          </div>
    
            <div class="list" id="list"> <!-- LISTA DE PEDIDOS -->
              <?php if($data['sales']): ?>
                <?php foreach ($data['sales'] as $k => $sale):?>
                  <a href="#" class="nvisto list-pedido"><p>#<?= $sale['id']?></p></a> <!-- ID DO PEDIDO -->
                <?php endforeach;?>
              <?php else:?>
                <div class="empty">
                  <div class="img-empty">
                    <img src="..\assets\css\saleManager\img/empty-folder.png" alt="">
                  </div>
                </div>
              <?php endif;?>
            </div>
        </div>
      <div class="card2"> <!-- GERENCIAR PEDIDO -->
        <div class="list"> <!-- LISTA DE PRODUTOS DO PEDIDO -->
          <?php if($data['sales']): ?>
              <?php foreach ($data['sales'] as $k => $sale):?>
                <div class="venda">
                  <div class="titulo-pedido">
                    <p class="titulo"><span>Gerenciar pedido #<?= $sale['id']?></span></p>
                    <div class="date"><?= $sale['saleDate']?></div>
                  </div>
                  <?php foreach ($sale['item'] as $a => $item):?>
                    <?php if($a != 0):?>
                      <hr class="linha">
                    <?php endif;?>
                    <div class="card3"> <!-- aqui é cada linha de produto -->
                      <div class="imagem"><img src="../imagem/<?= $item['product']['image']?>" ></div> <!-- IMAGEM DO PRODUTO -->
                      <div class="info">
                        <p class="name"><?= $item['product']['name']?></p>  <!-- NOME DO PRODUTO -->
                        <p><span>Quantidade:</span> <?= $item['quantity']?></p>  <!--QUANTIDADE DO PRODUTO -->
                        <!-- <p><span>Cor:</span> Rosa</p> COR DO PRODUTO -->
                        <p><span>Tamanho:</span> <?= $item['product']['size']['size']?></p> <!-- TAMANHO DO PRODUTO -->
                        <p><span>Preço:</span> <span class="formatar-preco"><?= $item['price']?></span></p> <!-- PRECO DO PRODUTO -->
                      </div>
                      <?php if($a == 0):?>
                        <div class="flex-venda">
                          <form action="../private/verificarVendaGerenciar.php" method="POST" class="situ-p">
                            <input type="hidden" name="idSale" value="<?= $sale['id']?>">
                            <input type="hidden" name="switch" value="update">
                            <p>Situação do pedido:</p>
                            <select name="status" id="" class="select"> <!-- SELECT SITUAÇÃO DO PEDIDO -->
                              <option value="2" <?php if($sale['status'] == 'Aguardando pagamento'): ?> selected <?php endif;?>>Aguardando pagamento</option>
                              <option value="3" <?php if($sale['status'] == 'Em preparo'): ?> selected <?php endif;?>>Em preparo</option>
                              <option value="4" <?php if($sale['status'] == 'A caminho'): ?> selected <?php endif;?>>A caminho</option>
                              <option value="5" <?php if($sale['status'] == 'Entregue'): ?> selected <?php endif;?>>Entregue</option>
                            </select>
                            <button class="salvar" name="salvar">Salvar</button> <!-- BOTÃO SALVAR -->
    
                          </form>
                          <form action="../private/verificarVendaGerenciar.php" method="POST" class="situ-p">
                            <input type="hidden" name="idSale" value="<?= $sale['id']?>">
                            <input type="hidden" name="switch" value="delete">
                            <button class="excluir">Cancelar pedido</button> <!-- BOTÃO EXCLUIR -->
                          </form>
                        </div>
                      <?php endif;?>
                    </div>
    
                  <?php endforeach;?>
                </div>
              <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="empty" id="empty"> <!-- PEDIDO VAZIO -->
          <div class="img-empty">
            <img src="..\assets\css\saleManager\img/corgi.png" alt="">
          </div>
          <p>Selecione um pedido</p>
        </div>
      </div>
    </div> <!-- FIM DO CONTEUDO DA PÁGINA -->
  </div>
  <?php 
  require_once('../libs/footer.php'); 
  ?>
<body>
  <script src="..\assets\js\saleManager\gestao_pedidos.js"></script>
</html>