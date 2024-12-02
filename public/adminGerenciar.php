<?php

use app\libs\admin\Admin;

require_once("../vendor/autoload.php");
require_once("../config.php");

$admin = new Admin;

session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: perfil.php");
  die();
}

if($_SESSION['user']['nivel'] != 3){
  header("Location: perfil.php");
  die();
}

$data['idAdmin'] = $_SESSION['user']['admin'];

$data['admin'] = $admin->displayAdmins($data);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar administradors</title> 
    <link rel="stylesheet" href="..\assets\css\admin\gestao_administrador.css">
    <link rel="stylesheet" href="..\assets\css\admin\gestao_administrador_responsivo.css">
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
          <div class="responsivo">
            <p class="titulo"><span>Administradores</span></p>
            <i class='bx bx-menu' id="burguer"></i> <!-- BOTÃO MENU RESPONSIVO -->
          </div>
    
            <div class="list" id="list"> <!-- LISTA DE administradorS -->
              <?php if($data['admin']):?>
                <?php foreach ($data['admin'] as $k => $admin):?>
                  <div class="user"><img src="..\assets\css\admin\img\do-utilizador.png" alt="" class="img-user"><a href="#" class="visto list-administrador"><p><?= $admin['name']?></p></a></div>
                <?php endforeach;?>
              <?php endif;?>
                <div class="user"><img src="..\assets\css\admin\img\add-perfil.png" alt="" class="img-user-add"><a href="#" class="visto list-administrador"><p>Adicionar</p></a></div>
            </div>
        </div>
        <div class="card2"> <!-- GERENCIAR administrador -->
            <p class="titulo"><span>Gerenciar administradores</span></p>
    
            <div class="list"> <!-- LISTA DE PRODUTOS DO administrador -->
            <?php if($data['admin']):?>
              <?php foreach ($data['admin'] as $k => $admin):?>
                <div class="card3"> <!-- aqui é cada linha de produto -->
                  <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div> <!-- IMAGEM DO PRODUTO -->
                  <div class="info">
                    <p class="name"><?= $admin['name'] ?></p>  <!-- NOME DO adm -->
                    <p><span>Email: </span> <?= $admin['email'] ?></p><!-- email adm -->
                    <p><span>Cpf: </span><span class="cpf"><?= $admin['cpf'] ?></span></p><!-- CPF adm -->
                    <p><span>Tel: </span><span class="telefone"><?= $admin['telephone'] ?></span></p> <!-- telefone adm -->
                  </div>
                  <div class="flex-adm">
                    <form action="../private/addAdmin.php" method="POST" class="situ-p">
                      <input type="hidden" name="idAdmin" value="<?= $admin['id'] ?>">
                      <input type="hidden" name="switch" value="alter">
                      <p>Nível do administrador:</p>
                      <select name="level" id="" class="select">
                          <option value="2" <?php if($admin['level'] == 2):?> selected <?php endif;?>>Administrador</option>
                          <option value="3" <?php if($admin['level'] == 3):?> selected <?php endif;?>>Administrador master</option>
    
                      </select>
                      <button class="salvar">Salvar</button> <!-- BOTÃO SALVAR -->
    
                    </form>
                    <form action="../private/addAdmin.php" method="POST" class="situ-p">
                      <input type="hidden" name="idAdmin" value="<?= $admin['id'] ?>">
                      <input type="hidden" name="switch" value="delete">
                      <button class="excluir">Excluir administrador</button> <!-- BOTÃO EXCLUIR -->
                    </form>
                  </div>
                </div>
              <?php endforeach;?>
            <?php endif;?>
              <form action="../private/addAdmin.php" method="POST" class="card3">
                <input type="hidden" name="switch" value="add">
                <div class="imagem"><img src="..\assets\css\admin\img\perfil.png" ></div>
                <div class="info-add">
                  <div class="info-p">
                    <p>Nome:</p>
                    <p>Email:</p>
                    <p>Cpf:</p>
                    <p>Número:</p>
                  </div>
                  <div class="info-input">
                    <input type="text" name="name" id="nome" class="input-add">
                    <input type="email" name="email" id="email" class="input-add">
                    <input type="number" name="cpf" id="tel" class="input-add">
                    <input type="number" name="number" id="tel" class="input-add">
                  </div>
                </div>
                <div class="flex-adm">
                  <div class="situ-p">
                    <p>Nível do administrador:</p>
                    <select name="level" id="" class="select">
                      <option value="2" >Administrador</option>
                      <option value="3" >Administrador master</option>
                    </select>
                    <button class="salvar">Cadastrar</button>
                    <button class="excluir">Cancelar</button>
                  </div>
                </div>
              </form>
              <!-- administrador VAZIO -->
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
  <script src="..\assets\js\admin\gestao_administrador.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

  <script>
    $("#CEP").mask("00000-000");
    $(".cpf").mask("000.000.000-00");
    $("#cartao").mask("0000 0000 0000 0000");
    $('.telefone').mask('(00) 00000-0000');
                    


  </script>
</html>