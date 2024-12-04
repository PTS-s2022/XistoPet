<?php

use app\libs\cart\Cart;
use app\libs\product\DisplayProduct;

require_once("../vendor/autoload.php");
require_once("../config.php");


$cart = new Cart;
$displayProduct = new DisplayProduct;

session_start();

if(!isset($_SESSION['user']['client'])){
    header("Location: login.php");
    die();
}

$data['idClient'] = $_SESSION['user']['client'];

$data = $cart->displayCart($data);
$data['cart']['totalPrice'] = 0;
$data['cart']['totalAmount'] = 0;
$data['cart']['totalItem'] = 0;

$value['category'] = 1;
$value['idProduct'] = 0;
$selectProduct = $displayProduct->selectProducts($value);

?>

<!DOCTYPE html>
<html lang="pt-br" id="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras</title>
    <link rel="stylesheet" href="../assets/css/cart/carrinho.css">
    <link rel="stylesheet" href="../assets/css/cart/carrinho-responsivo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">  
</head>
<body onload="carregado()" id="body">

    <div class="all" id="all"> <!-- Div que aparece quando a pessoa clica em limpar carrinho -->
        <div class="confirmar">
            <p class="titulo"><span>Limpar carrinho</span></p>
            <p>Tem certeza que deseja limpar o carrinho?</p>
            <p>Após a confirmação os intens do seu carrinho serão removidos</p>
            <div class="confirmacao">
                <a href="../private/alterarProdCarrinho.php?op=deleteItemAll" class="limpar"><button>Confirmar</button></a> <!-- aqui vai o php pra limpar a session -->
                <a class="comprar" id="cancelar"><button>Cancelar</button></a>
            </div>
        </div>
    </div>
    <div class="blur" id="blur"> <!-- blur pra aparecer a tela de confirmação para esvaiziar o carrinho -->

  <?php
    require_once('../libs/header.php');
  ?>      

        <div class="flex">   <!-- DIV QUE CONTÉM O CONTEUDO DA PAGINA-->
            <p class="titulo"><span>Carrinho de compra</span></p>  <!-- TITULO DO CONTEUDO DA PAGINA -->
            <div class="formularios">   <!-- DIV DOS FORMULARIOS -->
                <div class="info">
                    <!-- vou colocar o carrinho vazio aqui -->
                    <?php if(!isset($data['cart']['item'])): ?>
                        <div class="vazio">
                            <img src="../assets/css/cart/imagens/cachorro-caixa.png" alt="" class="img-vazio">
                            <div class="col-vazio">
                                <p class="sub-titulo"><span>Seu carrinho está vazio</span></p>
                                <p>Explore nosso site em busca de produtos que o interessam</p>
                                <a href="index.php" class="limpar"><button>Explorar</button></a>
                            </div>
                        </div>
                    
                    <?php endif;?>

                    <?php if(isset($data['cart']['item'])): ?>
                        <?php foreach ($data['cart']['item'] as $k => $item): ?>
                            <?php $esgotado = ""; ?>
                            <?php if(!$item['productSize']['stock']){
                              $esgotado = "esgotado";
                            }?>
                        <?php if ($k != 0 ):?>
                            <div class="separar"></div><!--  essa linha aparece quando tem mais de um item no carrinho -->
                        <?php endif;?>
                        <div class="linha <?= $esgotado ?>"> <!-- a div linha é para cada item do carrinho -->
                        
                        <img src="../imagem/<?= $item['product']['image'] ?>" alt="" class="img-produto <?= $esgotado ?>"> <!-- a imagem do produto -->
                        <div class="space">
                            <div class="col-1">
                                <div>
                                    <a href="" class="nome-produto <?= $esgotado ?>"><?= $item['product']['name'] ?></a> <!-- nome com o link para ir pra pagina do produto -->
                                </div>
                                <?php if($item['productSize']['stock'] != 0): ?>

                                
                                <div class="div-quantidade">
                                    <a href="../private/alterarProdCarrinho.php?op=remove&&idProductSize=<?= $item['productSize']['idProductSize'] ?>" class="btn-qtd"><button class="nada-branco">-</button></a>
                                    <span><?= $item['amount'] ?></span> <!-- a quantidade de produtos q serão comprados, dps tenho q ver se vai mudar para um input -->
                                    <a href="../private/alterarProdCarrinho.php?op=add&&idProductSize=<?= $item['productSize']['idProductSize'] ?>" class="btn-qtd"><button class="nada-branco">+</button></a>
                                </div>
                                <?php else: ?>
                                    <div class="texto-esgotado">Produto esgotado</div><!-- .texto-esgotado é o texto que ira aparecer quando o produto estiver esgotado  -->
                                <?php endif; ?>
                            </div>
                            <div class="col-2">
                                <div>
                                    <a href="../private/alterarProdCarrinho.php?op=delete&&idProductSize=<?= $item['productSize']['idProductSize'] ?>" class="nada"><button class="nada"> <i class='bx bx-trash'></i> </button></a> <!-- excuir o produto -->
                                </div>
                                <div>
                                    <p class="valor-produto formatar-preco"><?= $item['productSize']['price'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php $data['cart']['totalItem'] = count($data['cart']['item']); ?>
                            <?php $data['cart']['totalAmount'] += $item['amount']?>
                            <?php $data['cart']['totalPrice'] += $item['priceSubTotal']?>
                        <?php endforeach;?>
                    <?php endif;?>      
                    </div>
                </div>
        
            <div class="resumo-compra"> <!-- RESUMO DA COMPRA -->
                <aside>
                    <div class="box">
                        <div class="title">Resumo da compra</div>
                        <div class="conteudo">
                        <div><span class="s2">Produtos</span><span class="s1"><?= $data['cart']['totalItem'] ?></span></div>
                        <div><span class="s2">Quantidade</span><span class="s1"><?= $data['cart']['totalAmount'] ?></span></div>
                        <hr class="divisor">
                        <!-- <div><span class="s2">Subtotal</span><span class="s2">R$</span></div>
                        <hr class="divisor"> -->
                        <div><span class="s2">Frete</span><span class="s1">Grátis</span></div>
                        <hr class="divisor">
                        <div><span class="s2">Total</span><span class="s2 formatar-preco"><?= $data['cart']['totalPrice'] ?></span></div>
                        <div>
</div>
                        </div>
                        <div class="botoens">
                            <a href="../private/verificarVenda.php" class="comprar"><button>Comprar</button></a> <!-- acho que esses botões vão sumir se o carrinho estiver vazio -->
                            <a class="limpar" id="limpar">Limpar carrinho</a>
                        </div>
                    </div>
                </aside>
            </div>
        
        </div>  <!-- FIM DA DIV CONTEUDO DA PAGINA -->
        

<?php
require_once('../libs/productRelatedSelect.php');

require_once('../libs/footer.php');
?>
    
<script src="../assets/js/cart/carrinho.js?v=1.0" defer></script>

</body>
</html>