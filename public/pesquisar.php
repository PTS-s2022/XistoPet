<?php

use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");

$displayProduct = new DisplayProduct;


//Definindo variaveis
$error = 0;

if(isset($_GET['search'])){
    if (!$_GET['search']){
        header('Location: index.php');
    }


    $data['form'] = [
        "search" => $_GET['search']
    ];

    $data['search'] = $_GET['search'];

    $data['product'] = $displayProduct->searchProduct($data);

    $error = 1;
}

if(isset($_GET['category'])){
    $data['form'] = [
        "category" => $_GET['category']
    ];


    $data['search'] = $displayProduct->selectCategory($data['form']);
    if (!$data['search']) {
        header('Location: index.php');
    }

    $data['product'] = $displayProduct->selectProducts1($data);

    $error = 1;
}

if(!$error){
    header('Location: index.php');
}
$data['category'] = $displayProduct->displayCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <link rel="stylesheet" href="../assets/css/search/pesquisar.css">
    <link rel="stylesheet" href="../assets/css/search/pesquisar-responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body onload="carregado()">
 
<?php
  require_once('../libs/header.php');
?>
    
    <div class="flex"> <!-- CONTEUDO DA PAGINA -->
        <div class="categorias">   <!-- CATEGORIAS -->
            <p class="titulo2"><span>Categorias</span></p>
            <div class="c-list">
                <?php foreach ($data['category'] as $k => $category):?>
                    <?php ?>
                    <a href="pesquisar.php?category=<?= $category['id']?>"><?= $category['name']?></a>
                <?php endforeach;?>
            </div>
        </div>

        <div class="principal"> <!-- DIV DOS PRODUTOS -->
            <div class="responsivo">
                <p class="titulo2"><span>Resultados para <?= $data['search']?></span></p> 
                <!-- <div class="filtrar">
                    <span>Filtrar:</span>
                        <select name="filtrar" id=""></select>  SELECT CATEGORIA RESPONSIVO -->
                        <!-- <option value="filtro0"></option>
                        <option value="filtro1">Ração</option>
                        <option value="filtro2">Petiscos</option>
                        <option value="filtro3">Higiene</option>
                        <option value="filtro4">Brinquedos</option>
                        <option value="filtro5">Acessórios</option>
                        <option value="filtro6">Casinha</option>
                    </select>
                </div> -->
            </div>
            
            <div class="flex-relacionados">  
                <?php if($data['product']):?>
                    <?php foreach ($data['product'] as $k => $product): ?>
                        <div class="products">
                            <div class="star"><i class='bx bxs-star'></i><span><?= $product['assess']?></span></div> 
                            <div class="img-products"><img src="../imagem/<?= $product['image']?>" ></div>
                            <p> <?= $product['name']?></p> <!-- Nome do produto  -->
                            <div class="preco-flex">
                                <p class="preco"><?= $product['price']['min']?></p>
                                <p class="traco">-</p>
                                <p class="preco"><?= $product['price']['max']?></p>
                            </div> <!-- preço do produto -->
                            <a class="btn-adic" href="produto.php?idProduct=<?= $product['id']?>"><button class="nada-branco">Visualizar</button></a> <!-- ver se vai ter q colocar um a -->
                        </div>
                    <?php endforeach;?>
                <?php else:?>
                    
                        Nenhum produto encontrado
                    
                <?php endif;?>
                
            </div>
        </div>
    </div>
   
<?php
  require_once('../libs/footer.html');
?>
</body>
<script src="../assets/js/search/buscar.js"></script>
</html>