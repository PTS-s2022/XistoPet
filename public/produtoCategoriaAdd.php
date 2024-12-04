<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");

$product = New DisplayProduct;



session_start();

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data['switch'] = 'add';

if(isset($_GET['switch'])){
    $data['switch'] = $_GET['switch'];
}

if($data['switch'] == 'alter'){
    if(!isset($_GET['idCategory'])){
        header('Location: produtoCategoriaAdd.php');
    }
    $data['idCategory'] = $_GET['idCategory'];
    $data['category'] = $product->displayCategory($data);
    if(!$data['category']){
        header('Location: produtoCategoriaAdd.php');
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar categoria</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="..\assets\css\category\adicionar-categoria.css">
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


<?php switch ($data['switch']):
    case 'add': ?>
        <div class="principal">
            <p class="titulo"><span>Adicionar categoria</span></p>
            <form action="../private/addCategoria.php" method="POST" enctype="multipart/form-data" class="adic">
                <input type="hidden" name="switch" value="add">
                <div class="name">
                    <p class="sub-titulo">Nome:</p>
                    <input type="text" class="input" name="name">   <!-- NOME DA CATEGORIA -->
                </div>
                <div class="image">
                    <p class="sub-titulo">Selecionar imagem:</p>
                    <input type="file" name="foto-produto" id="foto-produto" accept="image/png,image/jpeg,image/webp"> <!-- IMAGEM DA CATEGORIA -->
                    <label class="foto" for="foto-produto">
                        <i class='bx bxs-camera-plus'></i>
                    </label>
                </div>
                <div class="div-image">
                    <img src="" alt="" class="img-categ" id="mostrar-img">
                </div>
                <button class="btn-salvar">Salvar</button>  <!-- BOTÃO SALVAR -->
            </form>
        </div>
        <?php break; ?>
    <?php case 'alter': ?>
       
        
        <div class="principal">
            <p class="titulo"><span>Alterar categoria</span></p>
            <form action="../private/addCategoria.php" method="POST" enctype="multipart/form-data" class="adic">
                <input type="hidden" name="switch" value="alter">
                <input type="hidden" name="idCategory" value="<?= $data['category']['id'] ?>">
                <div class="name">
                    <p class="sub-titulo">Nome:</p>
                    <input type="text" class="input" name="name" value="<?= $data['category']['name'] ?>">   <!-- NOME DA CATEGORIA -->
                </div>
                <div class="image">
                    <p class="sub-titulo">Selecionar imagem:</p>
                    <input type="file" name="foto-produto" id="foto-produto" accept="image/png,image/jpeg,image/webp" value="<?= $data['category']['image']?>"> <!-- IMAGEM DA CATEGORIA -->
                    <label class="foto" for="foto-produto">
                        <i class='bx bxs-camera-plus'></i>
                    </label>
                </div>
                <div class="div-image">
                    <img src="../imagem/categoria/<?= $data['category']['image']?>" alt="" class="img-categ" id="mostrar-img">
                </div>
                <button class="btn-salvar">Salvar</button>  <!-- BOTÃO SALVAR -->
            </form>
        </div>
        <?php break;
    endswitch;?>
    <?php
    require_once('../libs/footer.html');
    ?>
</body>
<script src="..\assets\js\category\add-categoria.js"></script>
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->

</html>