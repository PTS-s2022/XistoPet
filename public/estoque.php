<?php

use app\libs\product\DisplayProduct;
use app\libs\supplier\Supplier;

require_once("../vendor/autoload.php");
require_once("../config.php");

$product = new DisplayProduct;
$supplier = new Supplier;

session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}
if(!isset($_GET['idProduct'])){
    header('Location: produtoGerenciar.php');
    die();
}
$data['idProduct'] = $_GET['idProduct'];

$data['product'] = $product->displayProduct1($data);

if(!$data['product']){
  header("Location: index.php");
}

$data['supplier'] = $supplier->displaySuppliers();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar estoque</title> 
    <link rel="stylesheet" href="../assets/css/stock/estoque.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
</head>

<body onload="Carregado()">
  
<?php
    require_once('../libs/header.php');
  ?>     

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
      <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
        <p class="titulo1"><span>Gerenciar estoque</span></p>
          
        <form action="../private/addEstoque.php" method='POST' class="card"> <!-- GERENCIAR administrador -->
            <div class="div-select">
                <select name="Fornecedor" id="" class="select" required>
                    <option value="" disabled selected>Selecione um Fornecedor</option>
                    <?php if($data['supplier']):?>
                        <?php foreach ($data['supplier'] as $key => $supplier): ?>
                            <option value="<?= $supplier['id'] ?>"><?= $supplier['id'] ?> - <?= $supplier['name'] ?></option>
                        <?php endforeach;?>
                    <?php endif; ?>
                    
                </select>
            </div>
            <div class="content">
                <div class="image"><img src="../imagem/<?= $data['product']['image'][0]['image']?>" alt=""></div>
                <div class="list">
                    <?php foreach($data['product']['size'] as $k => $size):?>
                        <div class="input">   
                            <input type="hidden" name="idProductSize<?= $k?>" value="<?= $size['id']?>">
                            <span class="tamanho"><?= $size['size']?></span><input type="number" name="stock<?= $k ?>" id="" class="input-estoque" placeholder="Preencha o estoque">
                        </div>
                    <?php endforeach;?>
                    <div>
                        <input type="hidden" name="idProduct" value="<?= $data['idProduct']?>">
                    </div>
                </div>
            </div>
            <div class="div-button">
                <button class="btn">Salvar</button>
            </div>
        </form>
      </div> <!-- FIM DO CONTEUDO DA PÁGINA -->
  </div>

  <?php
  require_once('../libs/footer.php');
  ?>
<body>
  <script src="gestao_administrador.js"></script>
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->

</html>