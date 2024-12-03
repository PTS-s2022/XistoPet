<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar administradors</title> 
    <link rel="stylesheet" href="../assets/css/supplier/fornecedor.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="Carregado()">
<?php
  require_once('../libs/header.php');
?>  

  <div class="container-alto">
      <p class="titulo1"><span>Gerenciar administradores</span></p>
      <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
          <div class="card1">
      
      
              <div class="list" id="list"> <!-- LISTA DE fornecedor -->
      
                  <div class="user"><img src="..\assets\css\admin\img\do-utilizador.png" alt="" class="img-user"><a class="visto list-administrador"><p>Jean domingues</p></a></div>
                  <div class="user"><img src="..\assets\css\admin\img\add-perfil.png" alt="" class="img-user-add"><a class="visto list-administrador"><p>Adicionar</p></a></div>
              </div>
          </div>
          <div class="card2"> <!-- GERENCIAR administrador -->
              <p class="titulo"><span>Gerenciar fornecedores</span></p>
      
              <div class="list"> <!-- LISTA DE PRODUTOS DO administrador -->
      
               <form class="card3"> <!-- aqui é cada linha de produto -->
                  <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div> <!-- IMAGEM aleatoria -->
                  <div class="info">
                    <p class="name">Jean domingues</p>  <!-- NOME DO fornecedor -->
                    <p><span>CNPJ: </span><span class="cnpj">12345678000195</span></p><!-- cnpj fornecedor -->
                    <p><span>Tel: </span><span class="telefone">1299999999</span></p> <!-- telefone fornecedor -->
                  </div>
                  <div class="situ-p">
                    <button class="excluir">Excluir</button> <!-- BOTÃO EXCLUIR -->
                  </div>
                </form>
                <form class="card3" action="#">
                  <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div>
      
                  <div class="info-add">
                    <div class="info-p">
                      <p>Nome:</p>
                      <p>Telefone:</p>
                      <p>CNPJ:</p>
                    </div>
                    <div class="info-input">
                      <input type="text" name="nome" id="nome" class="input-add">
                      <input type="number" name="tel" id="tel" class="input-add">
                      <input type="number" name="cnpj" class="input-add">
                    </div>
                  </div>
                  <div class="situ-p">
                  
                    <button class="excluir">Cadastrar</button>
                  </div>
                </form>
                <!-- fornecedor VAZIO -->
                <div class="empty" id="empty">
                  <div class="img-empty">
                    <img src="..\assets\css\admin\img\corgi.png" alt="">
                  </div>
                  <p>Selecione um administrador</p>
                </div>
              </div>
          </div>
      </div> <!-- FIM DO CONTEUDO DA PÁGINA -->
  </div>
  <?php 
  require_once('../libs/footer.html'); 
  ?>
<body>
  <script src="../assets/js/supplier/fornecedor.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

  <script>
    $('.telefone').mask('(00) 00000-0000');                
    $('.cnpj').mask('00.000.000/0000-00');                
  </script>
</html>