<?php

use app\libs\client\Client;

require_once("../vendor/autoload.php");
session_start();
if(!isset($_SESSION['user']['client'])){  
    header('Location: index.php');
}

$client = new Client;

$data['idClient'] = $_SESSION['user']['client'];

$data['notification'] = $client->dataNotifications($data);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>notificaçôes</title>
    <link rel="stylesheet" href="..\assets\css\notification\notificacoes.css">
    <link rel="stylesheet" href="..\assets\css\notification\notificacoes_responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

  <!-- FIM DO CABEÇALHO -->

<body>

 <!-- FIM DO CABEÇALHO -->
<?php
  require_once('../libs/header.php');
?>  

 

  
  <div class="flex-notidicacao"> <!-- CONTEUDO DA PÁGINA -->
  
    <p class="titulo-notidicacao"><span>Notificações</span></p>
    
   

    <?php if(!$data['notification']):?>
      <div class="card2-notidicacao"> <!-- GERENCIAR PEDIDO -->
        <div class="list-notidicacao"> <!-- LISTA DE PRODUTOS DO PEDIDO -->
          <div class="centro-notidicacao"> <!-- CENTRO DA PAGINA-->
            <img src="..\assets\css\notification\img\imagem-semnotificacoes.png" alt="fazio" class="img-vazio-notidicacao"><!--img do pedidos vazio-->
          </div>


          </div> <!-- final da LISTA DE PRODUTOS DO PEDIDO -->
      </div>  <!-- final do card 2 -->
    <?php else: ?> 
          
      <div class="card2-notidicacao"> <!-- GERENCIAR PEDIDO -->
        <?php foreach ($data['notification'] as $k => $notification):?> 
          <?php if($k != 0):?>
            <hr class="hr">
          <?php endif; ?>
          <?php switch ($notification['type']):
            case 'avaliar': ?>
              <div class="card3-notidicacao"> <!-- card3-notidicacao é cada linha de notificacao -->
                <div class="coluns-notidicacao">
                  <div class="imagem-notidicacao"><i class='bx bxs-star'></i></div> <!-- aqui é o incone para a notificacao -->
                    <div class="info-notidicacao">
                      <p class="name-notidicacao">Gostaria de avaliar sua compra?</p>  <!-- titulo da notificacao -->
                      <p>De sua opinião sobre esse produto</p>
                    </div>
                </div>
                <div class="bottom-notidicacao"> 
                  <div class="texto-notidicacao"><a href="../public/pedido.php?idSaleItem=<?= $notification['item']?>">Ver mais </a></div>
                </div>
              </div> 


              <?php break;
            case 'pagamentoConfirmado': ?>

              <div class="card3-notidicacao"> <!-- card3-notidicacao é cada linha de notificacao -->
                <div class="coluns-notidicacao">
                  <div class="imagem-notidicacao"><i class='bx bx-check-circle'></i></div> <!-- aqui é o incone para a notificacao -->
                    <div class="info-notidicacao">
                      <p class="name-notidicacao">Seu pagamento foi confirmado</p>  <!-- aqui é o titulo da notificacao -->
                      <p>O pagamento para o produto corda colorida foi confirmado</p> <!-- texto da notificacao -->
                    </div>
                </div>
                <div class="bottom-notidicacao"> 
                  <div class="texto-notidicacao"><a href="../public/pedidos.php#<?= $notification['sale']?>">Ver mais </a></div>
                </div>
              </div> <!-- parte que vai o whaile -->
              
              <?php break;
            case 'pedidoACaminho': ?>
              <div class="card3-notidicacao"> <!-- card3-notidicacao é cada linha de notificacao -->
                <div class="coluns-notidicacao">
                  <div class="imagem-notidicacao"><i class='bx bx-accessibility'></i></div> <!-- aqui é o incone para a notificacao -->
                    <div class="info-notidicacao">
                      <p class="name-notidicacao">Seu pedido esta a caminho</p>  <!-- aqui é o titulo da notificacao -->
                      <p>Não gostaria de conferir essa, corda de brinquedo coloridas amada por cães</p> <!-- texto da notificacao -->
                    </div>
                </div>
                <div class="bottom-notidicacao"> 
                  <div class="texto-notidicacao"><a href="../public/pedidos.php#<?= $notification['sale']?>">Ver mais </a></div>
                </div>
              </div> 

              <?php break;
            case 'pedidoEntregue': ?>
              <div class="card3-notidicacao"> <!-- card3-notidicacao é cada linha de notificacao -->
                <div class="coluns-notidicacao">
                  <div class="imagem-notidicacao"><i class='bx bxs-flag-checkered'></i></div> <!-- aqui é o incone para a notificacao -->
                    <div class="info-notidicacao">
                      <p class="name-notidicacao">Seu pedido foi entregue</p>  <!-- aqui é o titulo da notificacao -->
                      <p>O pedido tal foi entregue no endereço requisitado</p> <!-- texto da notificacao -->
                    </div>
                </div>
                <div class="bottom-notidicacao"> 
                  <div class="texto-notidicacao"><a href="../public/pedidos.php#<?= $notification['sale']?>">Ver mais </a></div>
                </div>
              </div> 

              <?php break;
            case 'pedidoCancelado': ?>
              <div class="card3-notidicacao"> <!-- card3-notidicacao é cada linha de notificacao -->
                <div class="coluns-notidicacao">
                  <div class="imagem-notidicacao"><i class='bx bx-run'></i></div> <!-- aqui é o incone para a notificacao -->
                    <div class="info-notidicacao">
                      <p class="name-notidicacao">Seu pagamento foi cancelado</p>  <!-- aqui é o titulo da notificacao -->
                      <p>Seu pagamento não foi realizado, pois o pagamento não fois constado como realizado</p> <!-- texto da notificacao -->
                    </div>
                </div>
                <div class="bottom-notidicacao"> 
                  <div class="texto-notidicacao"><a href="#">Ver mais </a></div>
                </div>
              </div> 
              <?php break;?>
        <?php endswitch;?>
          
          

          

      
          

          

          
        <?php endforeach;?>  
      </div> <!-- final da LISTA DE PRODUTOS DO PEDIDO -->
        
    <?php endif;?>      
  </div>  <!-- final do card 2 -->
     
</div> <!-- FIM DO CONTEUDO DA PÁGINA -->

<body>
</html>