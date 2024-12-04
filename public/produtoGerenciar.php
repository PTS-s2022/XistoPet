<?php

use app\libs\product\DisplayProduct;


require_once("../vendor/autoload.php");
require_once("../config.php");



$product = new DisplayProduct;


session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data['product'] = $product->displayProducts();

$data['category'] = $product->displayCategories();

var_dump($data['product'][0]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link rel="stylesheet" href="..\assets\css\productManager\gestao-produtos.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3d2ec5edb8.js" crossorigin="anonymous"></script>
</head>

<body onload="Carregado()">
<?php
  require_once('../libs/header.php');
?>    

    <div class="container"> <!-- CONTEUDO DA PAGINA -->
        <div> <!-- CATEGORIAS -->
            <p class="title">Gerenciar categorias</p>
            <div class="list">
                <div class="square"> <!-- BOTÃO ADICIONAR CATEGORIA -->
                    <a href="produtoCategoriaAdd.php" class="btn-adic">Adicionar categoria</a>
                </div>
                <?php if(isset($data['category'])):?>
                  <?php foreach($data['category'] as $k => $category):?>
                    <div class="square"> <!-- DIV CATEGORIA -->
                        <div class="img">
                            <img src="../imagem/categoria/<?= $category['image']?>" class="img"> <!-- IMAGEM DA CATEGORIA -->
                        </div>
                        <p class="nome-c"><span><?= $category['name']?></span></p> <!-- NOME DA CATEGORIA -->
                        <form action="../private/addCategoria.php" method="POST" class="btn"> 
                            <input type="hidden" name="switch" value="delete">
                            <input type="hidden" name="idCategory" value="<?= $category['id']?>">
                            <a href="produtoCategoriaAdd.php?switch=alter&&idCategory=<?= $category['id']?>" class="btn-edit">Editar</a> <!-- BTN EDITAR CATEGORIA -->
                            <button class="btn-excluir">Excluir</button> <!-- BTN EXCLUIR CATEGORIAS -->
                        </form>
                    </div>
                  <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>

      <?php foreach ($data['category'] as $key => $category):?>
        <div>  <!-- Aqui vai ser cada categoria -->
            <p class="title">Gerenciar produtos da categoria <?= $category['name']?></p>
            <div class="list">
                <div class="square">
                    <a href="produtoAdd.php?idCategory=<?= $category['id']?>" class="btn-adic">Adicionar produto</a> <!-- BTN ADICIONAR PRODUTO-->
                </div>
                <?php if(isset($data['product'])):?>
                  <?php foreach($data['product'] as $k => $product):?>
                    <?php if($product['category'] == $category['id']):?>
                      <div class="square">
                          <div class="div-img-p"> 
                            <img src="../imagem/<?= $product['image']?>" class="img-p"> 
                          </div> <!-- IMAGEM DO PRODUTO -->
                          <a href="produto.php?idProduct=<?= $product['id']?>" class="link-p">
                            <p class="nome-p"><span><?= $product['name']?></span></p> <!-- NOME DO PRODUTO -->
                          </a>
                          <div class="preco-flex">
                              <p class="preco formatar-preco"><?= $product['price']['min']?></p>
                              <p class="traco">-</p>
                              <p class="preco formatar-preco"><?= $product['price']['max']?></p>
                          </div> <!-- PREÇO DO PRODUTO -->
                          <form action="../private/addProduct.php" method="POST" class="btn">
                            <input type="hidden" name="switch" value="delete">
                            <input type="hidden" name="idProduct" value="<?= $product['id']?>">
                            <a href="produtoAlterar.php?idProduct=<?= $product['id']?>" class="btn-edit">Editar</a> <!-- BTN EDITAR PRODUTO -->
                            <button class="btn-excluir">Excluir</button> <!-- BTN EXCLUIR PRODUTO -->
                          </form>
                          <div class="edt-estoque">
                            <a href="" class="a-estoque">Estoque</a>
                          </div>
                      </div>
                    <?php endif;?>
                  <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
      <?php endforeach;?>

        
        
    </div> <!-- FIM CONTEUDO DA PAGINA -->
    <?php 
    require_once('../libs/footer.html'); 
    ?>
</body>
<script src="../assets/js/productManager/gestao-produtos.js"></script>
</html>