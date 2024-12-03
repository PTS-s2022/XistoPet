<?php

use app\libs\supplier\Supplier;

require_once("../vendor/autoload.php");
require_once("../config.php");



$supplier = new Supplier;


session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}


$data['supplier'] = $supplier->displaySuppliers();

?>
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

    <!-- aqui é quando der erro, coloque o value=1 para aparecer o erro -->
  <?php if(isset($_SESSION['ERROR'])):?>
    <input type="hidden" name="inputErro" id="entrada-erro" value="1">
    <dialog id="erro">
        <h1 class="titulo-erro">Dados incorretos</h1>
        <div>
            <p class="p-erro"><?= $_SESSION['ERROR'] ?></p>
        </div>
        <div class="div-btn-erro">
            <button id="fechar">Fechar</button>
        </div>
    </dialog>
  <?php unset($_SESSION['ERROR']);?>
  <?php endif; ?>
  <div class="container-alto">
      <p class="titulo1"><span>Gerenciar administradores</span></p>
      <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
          <div class="card1">
      
      
              <div class="list" id="list"> <!-- LISTA DE fornecedor -->
              <?php if($data['supplier']):?>
                <?php foreach ($data['supplier'] as $key => $supplier): ?>
                  <div class="user"><img src="..\assets\css\admin\img\do-utilizador.png" alt="" class="img-user"><a class="visto list-administrador"><p><?= $supplier['name'] ?></p></a></div>
                <?php endforeach;?>
              <?php endif; ?>
                  <div class="user"><img src="..\assets\css\admin\img\add-perfil.png" alt="" class="img-user-add"><a class="visto list-administrador"><p>Adicionar</p></a></div>
              </div>
          </div>
          <div class="card2"> <!-- GERENCIAR administrador -->
              <p class="titulo"><span>Gerenciar fornecedores</span></p>
      
              <div class="list"> <!-- LISTA DE PRODUTOS DO administrador -->
                <?php if($data['supplier']):?>
                  <?php foreach ($data['supplier'] as $key => $supplier): ?>

                    <form class="card3" action="../private/addSupplier.php" method="POST"> <!-- aqui é cada linha de produto -->
                      <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div> <!-- IMAGEM aleatoria -->
                      <div class="info">
                        <p class="name"><?= $supplier['name'] ?></p>  <!-- NOME DO fornecedor -->
                        <p><span>CNPJ: </span><span class="cnpj"><?= $supplier['cnpj'] ?></span></p><!-- cnpj fornecedor -->
                        <p><span>Tel: </span><span class="telefone"><?= $supplier['telephone'] ?></span></p> <!-- telefone fornecedor -->
                        <input type="hidden" name="switch" value="delete">
                        <input type="hidden" name="idSupplier" value="<?= $supplier['id'] ?>">
                      </div>
                      <div class="situ-p">
                        <button class="excluir">Excluir</button> <!-- BOTÃO EXCLUIR -->
                      </div>
                    </form>
                  <?php endforeach;?>
                <?php endif; ?>
                <form class="card3" action="../private/addSupplier.php" method="POST">
                  <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div>
      
                  <div class="info-add">
                    <div class="info-p">
                      <p>Nome:</p>
                      <p>Telefone:</p>
                      <p>CNPJ:</p>
                    </div>
                    <div class="info-input">
                      <input type="hidden" name="switch" value="add">
                      <input type="text" name="name" id="nome" class="input-add">
                      <input type="number" name="telephone" id="tel" class="input-add">
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
  <script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->


  <script>
    $('.telefone').mask('(00) 00000-0000');                
    $('.cnpj').mask('00.000.000/0000-00');                
  </script>
</html>