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

$data = [
  'idClient' => $_SESSION['user']['client'],
  'idSaleItem' => $_GET['idSaleItem']
];


$data['sale'] = $sale->displaySaleItem($data);
// echo '<pre>';
// var_dump($data['sale']);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar Pedido</title>
  <link rel="stylesheet" href="..\assets\css\sale\pedido.css">
  <link rel="stylesheet" href="..\assets\css\sale\pedido_responsivo.css">

  <link
    href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>
<?php
  require_once('../libs/header.php');
?>
 
<!-- FIM DO CABEÇALHO -->

<body onload="Carregado()">

  <div class="tudo"><!--tudo-->
    <div class="div-pai"><!--pai-->
      <div class="div-filha1">
        <div class="div-interna filha-1"> <!--primeiro bloquinho-->
          <div class="esquerda" >
            <img src="../imagem/<?= $data['sale']['item']['product']['image']?>" alt="img" class="img-corda">
          </div>
          <div class="direita">
            <p class="titulo-principal"><?= $data['sale']['item']['product']['name'] ?></p> <!-- NOME DO PRODUTO -->
            <div class="info">
              <p><span>Quantidade:</span> <?= $data['sale']['item']['quantity']?>  </p> <!--QUANTIDADE DO PRODUTO -->
              <p><span>Tamanho:</span> <?= $data['sale']['item']['product']['size']['size'] ?></p> <!-- TAMANHO DO PRODUTO -->
              <p><span>Preço:</span> <span class="formatar-preco"> <?= $data['sale']['item']['price']?></span></p> <!--TAMANHODO PRODUTO -->
            </div>
            <a href="produto.php?idProduct=<?= $data['sale']['item']['product']['id']?>" class="link">Exibir detalhes do produto</a>
          </div>

        </div><!--fim do primiero ploquinho-->
        <?php if(!$data['sale']['item']['assess'] && $data['sale']['status'] == 5):?>
          <div class="div-interna filha-2"><!--segundo bloquinho-->
            <p>Gostou da sua compra?</p>
            <p><a href="produto.php?idProduct=<?= $data['sale']['item']['product']['id']?>&&saleItem=<?= $data['idSaleItem']?>#descricao" class="link" class="a-pedro">Avalie seu produto</a></p>
          </div> <!--fim do segundo bloquinho-->
        <?php endif;?>
      </div>
      <div class="div-filha2">
        <form action="../private/adicionaProdCarrinho.php" method="POST" class="div-interna filha-3"><!--terceiro bloquinho-->
          <input type="hidden" name="op" value="<?= $data['sale']['item']['product']['size']['id'] ?>">
          <input type="hidden" name="idProduct" value="<?= $data['sale']['item']['product']['id'] ?>">
          <input type="hidden" name="amount" value="<?= $data['sale']['item']['quantity'] ?>">
          
          <button class="button">
            <img src="..\assets\css\sale\img/update.png" alt="">Comprar novamente
          </button>
        </form> <!--fim terceiro bloquinho-->
        <div class="div-interna filha-4"> <!--quarto bloquinho-->

          <div class="informacao">
            <p class="titulo">Infomações do pedido</p>
            <hr>
            <p class="">Pagamento realizado <span class="date"><?= $data['sale']['saleDate'] ?></span></p>
            <?php if($data['sale']['deliveryDate']): ?>
              <p class="date">Pedido entregue em <?= $data['sale']['deliveryDate'] ?></p>
            <?php endif; ?>
          </div>
          
        </div> <!--fim do quarto bloquinho-->
      </div>
    </div><!--pai-->
  </div> <!--tudo-->



  </div> <!-- final do flex -->



<?php
  require_once('../libs/footer.html');
?>


  <body>
  <script src="../assets/js/sale/pedidos.js"></script>
</html>