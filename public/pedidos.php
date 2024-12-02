<?php

use app\libs\sale\Sale;

require_once("../vendor/autoload.php");
require_once("../config.php");

$sale = New Sale;

session_start();

if(!isset($_SESSION['user']['client'])){
  header("Location: login.php");
  die();
}

$data['idClient'] = $_SESSION['user']['client'];

$data['sale'] = $sale->displaySale($data);
// echo '<pre>';
// var_dump($data['sale']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>
    <link rel="stylesheet" href="../assets/css/sale/pedidos.css">
    <link rel="stylesheet" href="../assets/css/sale/pedidos_responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/TCC/header/header.css">
    <link rel="stylesheet" href="/TCC/header/header-reponsivo.css">

</head>

<body>

<?php
  require_once('../libs/header.php');
?>
 
  <div class="flex" > <!-- CONTEUDO DA PÁGINA -->
  
    <p class="titulo"><span>Pedidos </span></p>

    <?php if(!$data['sale']):?>
      <div class="cardVazio" > <!-- duplica o card inteiro  -->  
        <div > <!-- LISTA DE PRODUTOS DO PEDIDO -->
          <div class="centro"> <!-- CENTRO DA PAGINA-->
            <img src="../assets/css/sale/img/pedidos_vazio.png" alt="fazio" class="img-vazio"><!--img do pedidos vazio-->
            <div class="explorar">
              <p>Explore nosso site em busca de produtos que o interessam</p>
              <a href="" class="limpar"><button>Explorar</button></a>
            </div>
          </div>
 
        </div>   
      </div>  <!-- final LISTA DE PRODUTOS DO PEDIDO -->
    <?php else:?>
      <?php foreach ($data['sale'] as $k => $sale): ?>  
        <div class="card2" > <!-- GERENCIAR PEDIDO -->
          <div > <!-- LISTA DE PRODUTOS DO PEDIDO -->
            <div class="topo-card">
              <div class="dados-da-compra">
                <p><?= $sale['saleDate']?></p> <?php if($sale['status'] == 'Aguardando pagamento'):?><a href="vendaFinalizada.php?idSale=<?= $sale['id'] ?>"><?php endif; ?><p><?= $sale['status']?></p></a>
              </div>
            </div>

            <?php foreach ($sale['item'] as $a => $item):?>
              <div class="card3"> <!-- aqui é cada linha de produto -->
                <div class="coluns">
                  <div class="imagem"><img src="../imagem/<?= $item['product']['image']?>" ></div> <!-- IMAGEM DO PRODUTO -->
                  <div class="info">
                    <p class="name"><?= $item['product']['name']?></p>  <!-- NOME DO PRODUTO -->
                    <p><span>Quantidade:</span> <?= $item['quantity']?></p>  <!--QUANTIDADE DO PRODUTO -->
                    <!-- <p><span>Cor:</span> Rosa</p> COR DO PRODUTO -->
                    <p><span>Tamanho:</span> <?= $item['product']['size']['size']?></p> <!-- TAMANHO DO PRODUTO -->
                    <p><span>Preço:</span> <span class="formatar-preco"><?= $item['price']?></span></p> <!-- TAMANHO DO PRODUTO -->
                  </div>

                    <form action="../private/adicionaProdCarrinho.php" method="POST" class="situ-p">
                      <input type="hidden" name="op" value="<?= $item['product']['size']['id'] ?>">
                      <input type="hidden" name="idProduct" value="<?= $item['product']['id'] ?>">
                      <input type="hidden" name="amount" value="<?= $item['quantity'] ?>">
                      
                      <button class="comprar" type="submit">Adicionar ao carrinho</button> <!-- BOTÃO  COMPRAR -->
                      <a href="pedido.php?idSaleItem=<?=$item['id'] ?>" class="avalia">Ver mais </a> <!-- BOTÃO AVALIAR -->
                    </form>
                    

                </div>
              </div> <!-- aqui é cada linha de produto -->
            <?php endforeach;?>

          </div> <!-- final LISTA DE PRODUTOS DO PEDIDO -->
        </div>  
      <?php endforeach;?>
    <?php endif;?> 
    </div>
    </div> <!-- final do flex -->

    <?php
            require_once('../libs/footer.html');
        ?>
<body>
</html>