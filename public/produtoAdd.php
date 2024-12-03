<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");

$displayProduct = new DisplayProduct;

session_start();
if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data['switch'] = 'add';

if(isset($_POST['switch'])){
    $data['switch'] = 'add';
}

$data['category'] = $displayProduct->displayCategories();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto</title>
    <link rel="stylesheet" href="..\assets\css\productManager\adicionar-produto.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body onload="carregado()">
<?php
  require_once('../libs/header.php');
?>
    <!-- aqui é quando der erro, coloque o value=1 para aparecer o erro -->
    <input type="hidden" name="inputErro" id="entrada-erro" value="0">
    <dialog id="erro">
        <h1 class="titulo-erro">Dados incorretos</h1>
        <div>
            <p class="p-erro">Preencha todos os campos corretamente</p>
        </div>
        <div class="div-btn-erro">
            <button id="fechar">Fechar</button>
        </div>
    </dialog>

    <div class="principal"> <!-- DIV PRINCIPAL -->
        <p class="titulo"><span>Adicionar produto</span></p>
        <form action="../private/addProduct.php" method="POST" enctype="multipart/form-data" class="adic">
            <input type="hidden" name="switch" value='add'> 
            <div class="scroll">
                <p class="sub-titulo">Nome:</p>
                <input type="text" class="input" name="name" id="name"> <!-- INPUT NOME DO PRODUTO -->
            </div>
            
            <div class="scroll">
                <p class="sub-titulo">Categoria:</p>
                <select name="categoria" id="" class="input"> <!-- SELECIONAR CATEGORIA -->
                  <option value=""></option>
                  <?php foreach ($data['category'] as $k => $category):?>
                    <option value="<?= $category['id']?>"><?= $category['name']?></option>
                  <?php endforeach;?>
                    
                </select>
            </div>
           
            <div class="scroll"> 
                <p class="sub-titulo">Imagens:</p>
                <div class="image" id="image-container">
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
                            <input type="text" class="sizes input-tamanho" min="1" step="0.5" name="tamanho0"> <!-- INPUT TAMANHO -->
                        </div>
                        <p class="sub-titulo">Preço:</p>
                        <div class="flex" id="preco-p">
                            <input type="text"  class="sizes input-preco" name="preco0"> <!-- INPUT PREÇO-->
                        </div>

                        <div class="flex" id="idSize">
                            <input type="hidden" name="idSize0">
                        </div>
                        
                    </div>
                    <div class="add-preco">
                        <div class="adic-t" id="add-p-t"><i class='bx bx-plus'></i></div> <!-- BTN ADICIONAR TAMANHO -->
                    </div>
                </div>
           </div>


           <div class="scroll">
                <p class="sub-titulo">Descrição:</p>
                <textarea name="descricao" id="review-text" class="description"></textarea> <!-- DESCRIÇÃO DO PRODUTO -->
                <div class="char-count" id="char-count"><span id="ct">0</span> Caracteres</div>
           </div>

           <button class="btn-salvar">Salvar</button> <!-- BTN SALVAR -->
        </form>
    </div> <!-- FIM DA DIV PRINCIPAL -->
</body>
<script src='../assets/js/productManager/add-produto.js'></script>  <!-- script da cor -->
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->
</html>