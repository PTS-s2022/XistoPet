<?php
$cart = '../public/carrinho.php' ;
if(isset($_SESSION['user']['admin'])){  
    $cart = "../public/vendaGerenciar.php";
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
          <a id="notificacao"> <i class='bx bx-bell'><div class="ball-notifi"><span class="num-notifi">11</span></div></i></a> <!-- TELA PEDIDOS -->
          <a href="<?= $cart ?>"><i class='bx bx-cart'></i></a> <!-- TELA PEDIDOS -->
          <a href="../public/perfil.php"><i class='bx bx-user'></i></a> <!-- TELA CARRINHO -->
      </div>
  </nav>  <!-- FIM DAS INFORMAÇÕES DO CABEÇALHO -->
  <div class="notificacao" id="div-notificacao"> <!-- div que faz as notificaçoes aparecerem, o fundo branco -->
      <div class="container-notificacoes"><!-- Div que engloba todas as notificaçoes -->
          <div class="linha-notificacoes">
              <div class="sem-notificacao">
                  <img src="../assets/css/header/imagens/empty-folder.png" alt="empty-folder.png é o nome da imagem" class="notifi-vazio">Ainda não possui notificações
              </div>
          </div>


          <div class="linha-notificacoes"> <!-- cada uma das linhas das notificaçoes -->
              <img src="imagens/racao.webp" alt="" class="produto-notifi">
              <div class="content-notifi">
                  <div class="titulo-data-notifi">
                      <h1 class="titulo-notifi">titulo da notificação, pipipipopopo dasdasdasda d asdadsasdd</h1> 
                      <h1 class="data-notifi">03/08/2024</h1>
                  </div>
                  <div class="texto-notifi">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti perferendis impedit enim totam corporis fugit quibusdam. Magnam reiciendis dolorum eius optio, aperiam ullam, accusantium velit, iure deleniti blanditiis iusto rerum.
                  </div>
              </div>
          </div>


       
          <div class="linha-notificacoes"> <!-- aqui vai ter o link para a tela de notificações -->
              <a href="#" class="link-notificacao">Click aqui para ver todas as notificações</a>
          </div>
      </div>

      <!--  -->
  </div>
</header>   <!-- FIM DO CABEÇALHO -->

<script src="../assets/js/header/notificacao.js"></script>