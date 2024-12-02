<?php

use app\libs\product\DisplayProduct;
use app\libs\product\ProductComment;

require_once("../vendor/autoload.php");
require_once("../config.php");

session_start();

$displayProduct = new DisplayProduct;
$productComment = new ProductComment;

//Definindo variaveis
$data = [
    "idProduct" => $_GET['idProduct']
];

$data['comment'] = $displayProduct->dataComments($data);

if($data['comment'] == false){
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/product/produtos.css">
    <link rel="stylesheet" href="../assets/css/product/produtos-responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
  require_once('../libs/header.php');
?>

    <div class="description" id="block"> <!-- DIV COMENTARIOS -->
        <h1 class="h1-desc">Comentários</h1> <!--  TITULO COMENTARIO -->
        <?php if(isset($data['comment'])):?>
            <?php foreach ($data['comment'] as $k => $comment):?>    
                <div class="coment">  <!-- DIV DE CADA COMENTARIO -->
                    <div class="flex">
                        <p class="nome">João</p> <!-- NOME DO USUARIO -->
                        <div> <!--  DIV DAS ESTRELAS -->
                            <?php for ($i=1; $i <= 5; $i++):?>
                                <?php if ($comment['assess'] >= $i):?>
                                    <span class="estrela"><i class='bx bxs-star'></i></span>

                                <?php else:?>
                                    <span class="estrela"><i class='bx bx-star' ></i></span>
                                <?php endif;?>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p class="texto-coment"><?= $comment['comment'] ?></p>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <p class="texto-n-coment">  Esse produto não possui comentários</p>
        <?php endif;?>
        <div class="ver-mais">
            <a href="produto.php?idProduct=<?= $data['idProduct']?>">Voltar para o produto</a>
        </div>
    </div>

<?php
require_once('../libs/footer.html');
?>
</body>
</html>