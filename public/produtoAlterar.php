<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");
require_once("../config.php");

session_start();

$displayProduct = new DisplayProduct;

//Definindo variaveis
$data = [
  "idProduct" => $_GET['idProduct']
];
if(!$data['idProduct']){
    header("Location: index.php");
}

$data['product'] = $displayProduct->displayProduct1($data);
if($data == false){
  header("Location: index.php");
}


$data['category'] = $displayProduct->displayCategories();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar produto</title>
    <link rel="stylesheet" href="..\assets\css\productManager\adicionar-produto.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body onload="carregado()">
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

    <div class="principal"> <!-- DIV PRINCIPAL -->
        <p class="titulo"><span>Adicionar produto</span></p>
        <form action="../private/addProduct.php" method="POST" enctype="multipart/form-data" class="adic">
            <input type="hidden" name="switch" value='alter'>
            <input type="hidden" name="idProduct" value='<?= $data['product']['idProduct'] ?>'>
            <div class="scroll">
                <p class="sub-titulo">Nome:</p>
                <input type="text" class="input" name="name" id="name" value="<?= $data['product']['name'] ?>"> <!-- INPUT NOME DO PRODUTO -->
            </div>
            
            <div class="scroll">
                <p class="sub-titulo">Categoria:</p>
                <select name="categoria" id="" class="input"> <!-- SELECIONAR CATEGORIA -->
                  <option value=""></option>
                  <?php foreach ($data['category'] as $k => $category):?>
                    <option value="<?= $category['id']?>" <?php if($category['id'] == $data['product']['category']):?> selected <?php endif;?>><?= $category['name']?></option>
                  <?php endforeach;?>
                    
                </select>
            </div>
           
            <div class="scroll"> 
                <p class="sub-titulo">Imagens:</p>
                <div class="image" id="image-container">
                    <?php foreach ($data['product']['image'] as $k => $image):?>
                        <div class="IdnumFoto">
                            <input type="hidden" name="idImage<?= $k ?>" value="<?= $image['id'] ?>">  
                            <label class="Id-foto">
                                <div class="lx">
                                    <i class='bx bx-trash edt-image'></i>
                                </div>
                                <img src="../imagem/<?= $image['image'] ?>" alt="" class="img-ativo">
                            </label>
                        </div>
                    <?php endforeach;?>
                    <div class="numFoto">
                        <input type="file" name="foto-produto0" id="foto-produto0" class="foto-produto-add"> 
                        <label class="foto" for="foto-produto0">
                            <i class='bx bxs-camera-plus'></i>
                            <img src="" alt="" class="img-prod">
                        </label>
                    </div>
                    
                </div>
           </div>

           <div class="scroll">
                <div class="tamanho">
                    <div>
                        <p class="sub-titulo">Tamanho:</p>
                        <div class="flex" id="tamanho-p">
                            <?php foreach($data['product']['size'] as $k => $size):?>  
                                <input type="text" class="sizes input-tamanho none" min="1" step="0.5" name="tamanho<?= $k ?>" value="<?= $size['size'] ?>" tabIndex="-1"> <!-- INPUT TAMANHO -->
                            <?php endforeach;?>
                        </div>

                        <p class="sub-titulo">Preço:</p>
                        <div class="flex" id="preco-p">
                            <?php foreach($data['product']['size'] as $k => $size):?> 
                                <input type="text"  class="sizes input-preco" name="preco<?= $k ?>" value="<?= $size['price'] ?>"> <!-- INPUT PREÇO-->
                            <?php endforeach;?>
                        </div>
                        
                        <div class="flex" id="idSize">
                            <?php foreach($data['product']['size'] as $k => $size):?> 
                                <input type="hidden" name="idSize<?= $k ?>" value="<?= $size['id'] ?>">
                            <?php endforeach;?>
                        </div>
                        
                    </div>
                    <div class="add-preco">
                        <div class="adic-t" id="add-p-t"><i class='bx bx-plus'></i></div> <!-- BTN ADICIONAR TAMANHO -->
                    </div>
                </div>
           </div>


           <div class="scroll">
                <p class="sub-titulo">Descrição:</p>
                <textarea name="descricao" id="review-text" class="description"><?= $data['product']['description'] ?></textarea> <!-- DESCRIÇÃO DO PRODUTO -->
                <div class="char-count" id="char-count"><span id="ct">0</span> Caracteres</div>
           </div>

           <button class="btn-salvar">Salvar</button> <!-- BTN SALVAR -->
        </form>
    </div> <!-- FIM DA DIV PRINCIPAL -->
    <?php 
    require_once('../libs/footer.php'); 
    ?>
<script src='../assets/js/productManager/add-produto.js'></script>  <!-- script da cor -->
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->
</body>
</html>