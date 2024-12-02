<?php

use app\libs\client\ClientFavorite;
use app\libs\product\DisplayProduct;
use app\libs\product\ProductComment;

require_once("../vendor/autoload.php");
require_once("../config.php");

session_start();

$displayProduct = new DisplayProduct;
$productComment = new ProductComment;
$clientFavorite = new ClientFavorite;

//Definindo variaveis
$data = [
  "idProduct" => $_GET['idProduct']
];

$data = $displayProduct->displayProduct($data);
if($data == false){
  header("Location: index.php");
}

$selectProduct = $displayProduct->selectProducts($data);

$data['favorite'] = 0;

if(isset($_SESSION['user']['client'])){
    $value = [
        'idClient' => $_SESSION['user']['client'],
        'idProduct' => $data['idProduct']
    ];
    $foundFavorite = $clientFavorite->selectFavorite($value);
    if($foundFavorite){
        $data['favorite'] = 1;
    }
    
    if(isset($_GET['saleItem'])){
        $data['saleItem'] = $_GET['saleItem'];
        $value = [
            'idClient' => $_SESSION['user']['client'],
            'idSaleItem' => $data['saleItem'],
            'idProduct' => $data['idProduct']
        ];
        $data['assess'] = $productComment->displayAssess($value);
    }
    
}
?>


<!DOCTYPE html id>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="../assets/css/product/produtos.css">
    <link rel="stylesheet" href="../assets/css/product/produtos-responsivo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body onload="carregado()" id="body">
<?php if(isset($_SESSION['ERROR'])):?>
<div class="all" id="all"> 
    <div class="confirmar">
        <p class="titulo"><span>Limite de estoque</span></p>
        <p>A quantidade que deseja adicionar ao carrinho é maior que o estoque disponivel</p>
        <p>Confirme e adicione uma quantidade aceitavel</p>
        <div class="confirmacao">
            <div class="btn-confirmar" id="confirmar"><button>Confirmar</button></div> 
        </div>
    </div>
</div>
<?php unset($_SESSION['ERROR']);?>
<div class="blur" id="blur">
<?php endif?>

<?php if(isset($data['assess'])):?>
<?php if($data['assess']):?>
    <form action="../private/verificarAvaliarProduto.php" method="POST" class="all2" id="all2"> <!-- Div que aparece quando a pessoa clica em limpar carrinho -->
        <div class="confirmar2"><!-- corpo da tela que aparece -->
            <div class="container">
                <div class="topo">
                    <img src="../imagem/<?= $data['assess']['product']['image'] ?>" class="item">
                    <div>
                        <h2 class="item"><?= $data['assess']['product']['name'] ?></h2> <!-- Nome do produto -->
                        <p class="item">Esponha sua opiniao sobre o produto</p>
                        <div class="tamanho-avalia">
                            <p><?= $data['assess']['product']['size']['size'] ?></p>
                        </div>
                    </div>
                <div class="close-button" id="cancelar" > <!-- Botão de fechar -->
                    <i class='bx bx-x'></i>
                </div>
                </div>
                <div class="rating">
                    <input value="1" name="assess" id="star1" type="radio" class="input-stars">
                    <label for="star1" class="stars"></label>
                    <input value="2" name="assess" id="star2" type="radio" class="input-stars">
                    <label for="star2" class="stars"></label>
                    <input value="3" name="assess" id="star3" type="radio" class="input-stars">
                    <label for="star3" class="stars"></label>
                    <input value="4" name="assess" id="star4" type="radio" class="input-stars">
                    <label for="star4" class="stars"></label>
                    <input value="5" name="assess" id="star5" type="radio" class="input-stars">
                    <label for="star5" class="stars"></label>
                </div>
                
                <input type="hidden" name="saleItem" value="<?= $data['saleItem']?>">
                <input type="hidden" name="product" value="<?= $data['idProduct']?>">

                <div class="textarea-container">
                    <textarea id="review-text" maxlength="500" name="comment" ></textarea>
                </div>
                <!-- Contador de caracteres fora do textarea -->
                <div class="char-count" id="char-count"><span id="ct">0</span>/500</div>
        
                <div class="info-text-avalia">
                    As avaliações são públicas e incluem informações sobre sua conta e seu dispositivo. Todos podem ver o nome da sua Conta do Google, além do tipo de dispositivo associado à avaliação. Os desenvolvedores também conseguem ver seu país e informações do dispositivo (como idioma, modelo e versão do SO) e podem usar esses dados para dar uma resposta. Os usuários e o desenvolvedor do app vão ter acesso a edições anteriores, a menos que você exclua sua avaliação.
                    <p><a href="#">Saiba mais...</a></p>
                </div>
        
                <div class="button-avaliar-container">
                    <button class="button-avaliar" id="submit-button-avaliar" onclick="submitReview()">Enviar</button>
                </div>
            </div>
            
        </div>
    </form>
<?php endif;?>
<?php endif;?>

    <div class="blur2" id="blur2">
    
<?php
  require_once('../libs/header.php');
?>

<div class="description"> <!-- DIV SOBRE O PRODUTO -->
    <div class="mini"> <!-- IMAGENS DETALHADAS DO PRODUTO -->
        <?php foreach($data['image'] as $key => $image):?>
            <div class="mini-produto" id="icon-img<?= $key ?>"><img src="../imagem/<?= $image ?>" class="img-mini no-select"></div>
        <?php endforeach;?>
    </div>

    <div class="produto"><img src="../imagem/<?= $data['image'][0]?>" id="img-produto" class="no-select-img"></div> <!-- IMAGEM DO PRODUTO 1 -->



    <div class="avalia"> <!-- DESCRIÇÃO DO PRODUTO -->
        <div>
            <button class="btn"><i class='bx bxs-star'></i><p><?= $data['assessment']?></p></button> <!-- AVALIAÇÕES -->
            <a href="#comentarios" class="nada-branco"><button class="btn"><i class='bx bxs-chat'></i><p>Comentários</p></button></a> <!-- COMENTÁRIOS -->
            <a href="../private/verificarFavoritos.php?product=<?= $data['idProduct'] ?>" class="nada-branco"><button class="btn"><i class='bx <?php if($data['favorite']):?>bxs-heart <?php else: ?> bx-heart <?php endif; ?>'></i></button></a> <!-- COMENTÁRIOS -> quando o produto estiver nos favoritos tem q ser a class bxs-heart -->
            
        </div>
        <h1 id="h1"><?= $data['name'] ?></h1> <!-- NOME DO PRODUTO -->
        <h1 id="preco" class="preco-produto"></h1><!--  PREÇO -->
        <h1 class="produto-esgotado" id="produto-esgotado"></h1><!-- Quando não tiver nunhum produto no estoque-->
        <h1 class="qtd-produto" id="quantidade"></h1><!-- Quando não tiver nunhum produto no estoque-->
        <h2 id="h2">Tamanhos</h2> 
        <form action="../private/adicionaProdCarrinho.php" method="post">
        <input type="hidden" name="idProduct" value="<?= $data['idProduct'] ?>">
            <div class="op">
                
                <?php foreach($data['size'] as $k => $size):?>
                    <div class="op-produto"> <!-- ESCOLHER TAMANHO/COR -->
                        <input type="number" name="preco<?= $k ?>" class="input-preco" value="<?= $size['price'] ?>" step="0.01" hidden>
                        <input type="number" name="qtd<?= $k ?>" class="input-qtd" value="<?= $size['stock'] ?>" step="0" hidden>
                        <input type="radio" name="op" id="size<?= $k ?>" class="input-radio input-tamanho" value="<?= $size['id'] ?>">

                        <?php $selectTamanho = '';?>
                        <?php $selectLinha = '';?>
                        <?php if($size['stock'] == 0): ?>
                        
                        <?php $selectLinha = 'esgotado-linha';?>
                        <?php $selectTamanho = 'esgotado-tamanho';?>
                        <?php endif; ?>
                        
                        <label for="size<?= $k ?>" class="select-tamanho <?= $selectTamanho ?>"> <!-- class="esgotado-tamanho" Class esgotado-tamanho é pra quando um tamnho não estiver disponivel-->
                            <span><?= $size['size'] ?></span>
                            <div class="<?= $selectLinha ?>"></div>
                        </label>
                        

                    </div>
                <?php endforeach;?>
            </div>

            <?php if($data['color'] != 0):?>
                <h2 class="h2">Cores</h2> 
                <div class="color">
                    <!-- <div class="selct-cor">
                        <input type="radio" name="cor" id="cor1" class="input-color" value="#0896C5" required>
                        <label for="cor1" class="label-cor esgotado-cor"> 
                        </label>
                    </div> --> <!-- esgotado-cor é pra quando uma cor estiver esgotada-->
                    <?php foreach($data['color'] as $k => $color):?>
                    <div class="selct-cor">
                        <input type="radio" name="cor" id="cor<?= $k ?>" class="input-color" value="<?= $color['color'] ?>">
                        <label for="color<?= $k ?>" class="label-cor">
                            
                        </label>
                    </div>
                    <?php endforeach;?>
                 
                </div>
            <?php endif;?>

            <?php if(!isset($_SESSION['user']['admin'])):?>
                <div class="div-quantidade" id="div-quantidade">
                    <div class="btn-qtd" id="tira">-</div>
                    <input type="number" name="amount" id="qtd-adc" value="1"> <!-- a quantidade de produtos q serão comprados, dps tenho q ver se vai mudar para um input -->
                    <div class="btn-qtd" id="coloca">+</div>
                </div>
                <button class="btn-carrinho" id="add-carrinho">Adicionar ao Carrinho</button> <!-- BOTAO ADICIONAR AO CARRINHO --> 
                    
            <?php else:?>
                <a href="produtoAlterar.php?idProduct=<?= $data['idProduct'] ?>" class="btn-carrinho" id="edt-produto">Alterar Produto</a> <!-- BOTAO ADICIONAR AO CARRINHO --> 

            <?php endif;?>
        
             
        </form>
        
    </div> <!-- FIM DA DESCRIÇÃO DO PRODUTO -->
    
    
</div> <!-- FIM DA DIV SOBRE O PRODUTO -->

<div class="description" id="block"> <!-- DIV COMENTARIOS -->
    <h1 class="h1-desc" id="comentarios">Comentários</h1> <!--  TITULO COMENTARIO -->
    <?php if($data['comment']):?>
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
        <div class="ver-mais">
            <a href="comentarios.php?idProduct=<?= $data['idProduct']?>">Ver todos os comentários</a>
        </div>
    <?php else:?>
        <p class="texto-n-coment">  Esse produto não possui comentários</p>
    <?php endif;?>
    
</div>

<!-- INFORMAÇÕES ADICIONAIS DO PRODUTO -->
<div class="description" id="block"> 
    <h1 class="h1-desc">Descrição do produto:</h1> 
    <p><?= $data['description'] ?></p>
</div> <!-- FIM DAS INFORMAÇÕES ADICIONAIS -->


<div class="alert" id="alert">
    <div class="linha-alert">
        <i class='bx bx-error'></i>
        <div id="alert2"></div>
    </div>
    <div class="vazio" id="tempo"></div>
</div>
<?php if(isset($data['assess'])):?>
    <?php if($data['assess']):?>
        <!-- avalição -->
        <div class="description2" id="block" > 
            <h1 class="h1-desc" id="avaliar">Avalie o Produto</h1> 
            <div class="flex2">
                <div class="estrela">        
                    <div class="rating" id="clicar">
                        <label for="" class="stars2"></label>
                        <label for="" class="stars2"></label>
                        <label for="" class="stars2"></label>
                        <label for="" class="stars2"></label>
                        <label for="" class="stars2"></label>
                        </div>
                </div>
                <div class="div-avaliar">
                    <button class="btn-avaliar" id="adicionar2">Adicionar comentário</button>
                </div>
            </div>
        </div>     
        <!-- avalição -->
    <?php endif;?>
<?php endif;?>
    


<?php
if($selectProduct){
    require_once('../libs/productRelatedSelect.php');
}


require_once('../libs/footer.html');
?>

</div>
<script src="../assets/js/product/adicionar-avaliação.js"></script>
<script src="../assets/js/product/produtos.js"></script>
<script src="../assets/js/product/produtos-qtd.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="jquery.maskMoney.js" type="text/javascript"></script>
</body>
</html>

