<?php

use app\libs\client\Client;


$cart = '../public/carrinho.php' ;
if(isset($_SESSION['user']['admin'])){  
    $cart = "../public/vendaGerenciar.php";
}

if(isset($_SESSION['user']['client'])){  
    $client = new Client;
    $data['idClient'] = $_SESSION['user']['client'];
    $data['notification'] = $client->dataNotification($data);
    $count = null;
    if($data['notification']){
        $count = count($data['notification']);
    }
}

?>



<head>
    <link rel="stylesheet" href="../assets/css/header/header.css">
    <link rel="stylesheet" href="/header/header-reponsivo.css">
</head>
<header class="no-select"> <!-- CABEÇALHO -->
  <nav class="nav-header"> <!-- INFORMAÇÕES DO CABEÇALHO -->
      <a href="index.php" class="logo"></a> <!-- LOGO -->
      
      <form class="group" action="pesquisar.php"> <!-- BARRA DE PESQUISA -->
          <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
          <input placeholder="Search" type="search" name="search" class="input-pesquisa">
        
      </form> <!-- FIM DA BARRA DE PESQUISA -->
     
      <div class="nav-list"> 
      <?php if(isset($data['notification'])): ?><a id="notificacao"> <i class='bx bx-bell'><div class="ball-notifi"><span class="num-notifi"><?= $count ?></span></div></i></a> <!-- TELA PEDIDOS --><?php endif;?>
          <a href="<?= $cart ?>"><i class='bx bx-cart'></i></a> <!-- TELA PEDIDOS -->
          <a href="../public/perfil.php"><i class='bx bx-user'></i></a> <!-- TELA CARRINHO -->
      </div>
  </nav>  <!-- FIM DAS INFORMAÇÕES DO CABEÇALHO -->
  <?php if(isset($data['notification'])): ?>
  <div class="notificacao" id="div-notificacao"> <!-- div que faz as notificaçoes aparecerem, o fundo branco -->
      <div class="container-notificacoes"><!-- Div que engloba todas as notificaçoes -->
      <?php if(!$data['notification']): ?>
          <div class="linha-notificacoes">
              <div class="sem-notificacao">
                  <img src="../assets/css/header/imagens/empty-folder.png" alt="empty-folder.png é o nome da imagem" class="notifi-vazio">Ainda não possui notificações
              </div>
          </div>
      <?php else:?>
        <?php foreach ($data['notification'] as $k => $notification):?>
          <div class="linha-notificacoes"> <!-- cada uma das linhas das notificaçoes -->
              
            
                <?php switch ($notification['type']):
                    case 'avaliar': ?>
                        <div class="imagem-notificacao-header"><i class='bx bxs-star'></i></div> <!-- aqui é o incone para a notificacao -->

                        
                        <div class="content-notifi">
                            <div class="titulo-data-notifi">
                            <h1 class="titulo-notifi"><a href="../public/pedido.php?idSaleItem=<?= $notification['item']?>">Gostaria de avaliar sua compra?</a></h1> 
                                <h1 class="data-notifi"><?= $notification['date']?></h1>
                            </div>
                            <div class="texto-notifi">
                                De sua opinião sobre esse produto
                            </div>
                        </div>

                        <?php break;
                    case 'pagamentoConfirmado': ?>
                        <div class="imagem-notificacao-header"><i class='bx bx-check-circle'></i></div> <!-- aqui é o incone para a notificacao -->

                    
                        <div class="content-notifi">
                            <div class="titulo-data-notifi">
                            <h1 class="titulo-notifi"><a href="../public/pedidos.php#<?= $notification['sale']?>">Seu pagamento foi confirmado</a></h1> 
                            <h1 class="data-notifi"><?= $notification['date']?></h1>
                            </div>
                            <div class="texto-notifi">
                                O pagamento para a venda <?= $notification['sale']?> foi confirmado
                            </div>
                        </div>    
                        <?php break;
                    case 'pedidoACaminho': ?>
                        <div class="imagem-notificacao-header"><i class='bx bx-accessibility'></i></div> <!-- aqui é o incone para a notificacao -->
    
                        <div class="content-notifi">
                            <div class="titulo-data-notifi">
                                <h1 class="titulo-notifi"><a href="../public/pedidos.php#<?= $notification['sale']?>">Seu pedido esta a caminho</a></h1> 
                                <h1 class="data-notifi"><?= $notification['date']?></h1>
                            </div>
                            <div class="texto-notifi">
                                O pagamento para a venda <?= $notification['sale']?> foi confirmado
                            </div>
                        </div>

                        <?php break;
                    case 'pedidoEntregue': ?>
                        <div class="imagem-notificacao-header"><i class='bx bxs-flag-checkered'></i></div> <!-- aqui é o incone para a notificacao -->
                       
                        
                        <div class="content-notifi">
                            <div class="titulo-data-notifi">
                            <h1 class="titulo-notifi"><a href="../public/pedidos.php#<?= $notification['sale']?>">Seu pedido foi entregue</a></h1> 
                            <h1 class="data-notifi"><?= $notification['date']?></h1>
                            </div>
                            <div class="texto-notifi">
                                O pedido <?= $notification['sale']?> foi entregue no endereço requisitado
                            </div>
                        </div>
                        <?php break;

                    case 'pedidoCancelado': ?>
                        <div class="imagem-notificacao-header"><i class='bx bx-run'></i></div> <!-- aqui é o incone para a notificacao -->
                        
                        
                        <div class="content-notifi">
                            <div class="titulo-data-notifi">
                            <h1 class="titulo-notifi">Seu pagamento foi cancelado</h1> 
                            <h1 class="data-notifi"><?= $notification['date']?></h1>
                            </div>
                            <div class="texto-notifi">
                                Seu pagamento não foi realizado, pois o pagamento não pois constado como realizado
                            </div>
                        </div>
                    <?php break;?>
                <?php endswitch;?>
               

          </div>
        <?php endforeach;?> 
      <?php endif;?>       

       
          <div class="linha-notificacoes"> <!-- aqui vai ter o link para a tela de notificações -->
              <a href="notificacao.php" class="link-notificacao" tabIndex="-1">Click aqui para ver todas as notificações</a>
          </div>
      </div>
      
      <!--  -->
  </div>
  <?php endif;?>
</header>   <!-- FIM DO CABEÇALHO -->

<script src="../assets/js/header/notificacao.js"></script>