<?php

use app\libs\cart\Cart;
use app\libs\client\Client as Client;
use app\libs\sale\Sale;

require_once("../vendor/autoload.php");
require_once("../config.php");


$sale = new Sale;
$client = new Client;
$cart = new Cart;

session_start();

if(!isset($_SESSION['user']['client'])){
  header("Location: index.php");
  die();
}
if(isset($_GET['switch'])){
    $data['switch'] = $_GET['switch'];
}

$data['idClient'] = $_SESSION['user']['client'];

$data = $cart->displayCart($data);

$data['switch'] = $sale->verifySale($data);

$data['client'] = $client->displayClient($data);

if(isset($data['cart']['address'])){
    
    if (isset($data['cart']['address']['complement'])) {
        $data['cart']['address']['complement'] = $data['cart']['address']['complement'] . ' , ';
    }
    else {
        $data['cart']['address']['complement'] = '';
    }

}

if($data['switch']['switch'] == 'product'){
  header("Location: ../public/carrinho.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="../assets/css/sale/finalizar_compra.css">
    <link rel="stylesheet" href="../assets/css/sale/finalizar-compra-responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3d2ec5edb8.js" crossorigin="anonymous"></script>
</head>

<body onload="carregado()" onresize="mudouTamanho()">
<header> <!-- CABEÇALHO -->
    <nav> <!-- INFORMAÇÕES DO CABEÇALHO -->
        <a href="#" class="logo"></a> <!-- LOGO -->
        <a href="../public/carrinho.php" class="voltar"><i class='bx bx-left-arrow-circle'></i><span>Voltar para o carrinho</span></a>
    </nav>  <!-- FIM DAS INFORMAÇÕES DO CABEÇALHO -->
</header>   <!-- FIM DO CABEÇALHO -->

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

<div class="flex">   <!-- DIV QUE CONTÉM O CONTEUDO DA PAGINA-->
    <p class="titulo"><span>Finalizar compra</span></p>  <!-- TITULO DO CONTEUDO DA PAGINA -->
    <div class="formularios">   <!-- DIV DOS FORMULARIOS -->
      <?php switch ($data['switch']['switch']):
        case 'address': ?>
            <form action="../private/verificarVenda.php" method="post" class="form"> <!-- FORM ENDEREÇOS -->
                <div class="info">  <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                    <div class="titulo2"><i class='bx bx-location-plus'></i><span>Endereços</span></div> 
                    <div class="select-endereco"> <!-- div q engloba as tudo dos endereços existentes -->
                        <?php if(!$data['client']['address']):?>
                            <p id="msgm">Você não posssui endereços cadastrados</p>
                        <?php else: ?>
                            <?php foreach ($data['client']['address'] as $k => $address): ?>
                                <label for="endereco<?= $k ?>"> <!-- div de cada linha dos endereços, até o edt e o excluir -->
                                    <?php
                                    $complement = '';
                                    if ($address->complemento) {
                                    $complement = $address->complemento. ' , ';
                                    }?>
                                    <input type="radio" name="address" id="endereco<?= $k ?>" class="radio" value="<?= $address->id ?>"/> <!-- input radio com display: none -->
                                    <div class="select-adress">
                                        <div class="nome-endereco"><?= $address->logradouro . ' , ' . $address->numero . ' , '. $complement  . $address->bairro . ' - ' . $address->cidade . '/' . $address->estado  . ' - ' . $address->cep?></div>
                                        
                                        <label for="endereco<?= $k ?>"> <!-- label q encaminha o input -->
                                        <div></div> <!-- bolinha de dentro do label -->
                                        </label>
                                    </div>
                                    <div class="edt">
                                        <a href="addEndereco.php?address=<?= $address->id?>" class="none"><i class="bx bx-edit-alt"></i></a>
                                        <a href="../private/verificarEndereco.php?address=<?= $address->id?>" class="none"><i class="bx bx-trash"></i></a>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- salvar endereço -->
                        <div class="salvar">   
                            <a href="addEndereco.php?controler=1" class="btn a-formatado">Adicionar outro</a>
                            <button class="btn btn-amarelo">Continuar</button>
                        </div>
                    </div>
                </div>
            </form>


            <?php break; ?>
        
        <?php case 'cpf': ?>
            <div class="concluido"> <!-- ENDEREÇO CONCLUIDO -->
                <div class="titulo3"><i class='bx bx-check-circle'></i><span >Endereço:</span></div>
                <span><?= $data['cart']['address']['publicPlace'] . ' , ' . $data['cart']['address']['number'] . ' , '. $data['cart']['address']['complement']  . $data['cart']['address']['neighborhood'] . ' - ' . $data['cart']['address']['city'] . '/' . $data['cart']['address']['state']  . ' - ' . $data['cart']['address']['cep']?><a href="venda.php?switch=address" class="none"><i class="bx bx-edit-alt"></i></a></span>
            </div>

            <div class="form"> <!-- FORM FRETE -->
            <div class="info"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                <div class="titulo2"><i class='bx bxs-truck'></i><span>Frete</span></div>
                <div class="frete">
                    <span>A chegada do seu pedido está prevista para 12/12 </span>
                    <div class="frete-gr">Grátis</div>
                </div>
            </div>
            </div>

            <form action="../private/verificarVenda.php" method="post" class="form"> <!-- FORM CUPOM DE DESCONTO -->
            <div class="info"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                <div class="titulo2"><i class='bx bx-credit-card-front'></i><span>CPF</span></div>
                <input type="text" class="desconto" name="cpf" placeholder="Entre com o seu CPF">
                <div class="salvar">
                    <button class="btn btn-amarelo">Continuar</button>
                </div>
            </div>
            </form>
        
            <?php break; ?>

        <?php case 'paymentMethod': ?>
            <div class="concluido"> <!-- ENDEREÇO CONCLUIDO -->
                <div class="titulo3"><i class='bx bx-check-circle'></i><span >Endereço:</span></div>
                <span><?= $data['cart']['address']['publicPlace'] . ' , ' . $data['cart']['address']['number'] . ' , '. $data['cart']['address']['complement']  . $data['cart']['address']['neighborhood'] . ' - ' . $data['cart']['address']['city'] . '/' . $data['cart']['address']['state']  . ' - ' . $data['cart']['address']['cep']?><a href="venda.php?switch=address" class="none"><i class="bx bx-edit-alt"></i></a></span>
            </div>

            <div class="form"> <!-- FORM FRETE -->
            <div class="info"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                <div class="titulo2"><i class='bx bxs-truck'></i><span>Frete</span></div>
                <div class="frete">
                    <span>A chegada do seu pedido está prevista para 12/12 </span>
                    <div class="frete-gr">Grátis</div>
                </div>
            </div>
            </div>

            <form action="../private/verificarVenda.php" method="post" class="form"> <!-- FORM METODO DE PAGAMENTO -->
                <div class="info" id="verificar"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                    <div class="titulo2"><i class='bx bxs-coin-stack'></i><span>Método de pagamento</span></div>
                    <div class="metodo">
                        <div class="flex-pag"> <!-- DIV PARA ESCOLHER O METODO DE PAGAMENTO -->
                            <div class="metodo-pag">
                                <input type="radio" name="method" id="pix" class="radio-pag" value="1"  checked>
                                <label for="pix" class="label-pag">
                                    <i class="fa-brands fa-pix"></i>
                                    <span>Pix</span>
                                </label>
                            </div>

                            <div class="metodo-pag">   <!-- MUDAR -->
                                <input type="radio" name="method" id="cartao" class="radio-pag" value="3" >
                                <label for="cartao" class="label-pag">
                                    <i class="fa-regular fa-credit-card"></i>
                                    <span>Cartão de crédito</span>
                                </label>
                            </div>

                            <div class="metodo-pag">
                                <input type="radio" name="method" id="boleto" class="radio-pag" value="2">
                                <label for="boleto" class="label-pag">
                                    <i class='bx bx-barcode'></i>
                                    <span>Boleto</span>
                                </label>
                            </div>
                        </div>
                        

                        <div class="select-endereco" id="aparecer">  <!-- APARECER -->


                            <!-- Mensagem caso nao tenha cartao cadastrado -->
                        <?php if(!$data['client']['card']):?>
            
                            <div class="mensage">
                                 <span>Você não tem nenhum cartão cadastrado</span>
                             </div>
                        <?php else: ?>
                            <?php foreach ($data['client']['card'] as $k => $card): ?>
                                <label for="cartao<?= $k ?>"> 
                                    <input type="radio" name="card" id="cartao<?= $k ?>" class="radio" value="<?= $card->id ?>"/> 
                                    <div class="select-adress">
                                        <div class="nome-endereco"><?= $card->nomeTitular ?>, <?= $card->numero ?></div>
                                        <label for="cartao<?= $k ?>"> 
                                        <div></div> 
                                        </label>
                                    </div>
                                    <div class="edt">
                                        <a href="../private/verificarCartao.php?card=<?= $card->id ?>" class="none"><i class="bx bx-trash"></i></a>
                                    </div>
                                </label>
                            <?php endforeach?>
                        <?php endif; ?>
                            <div class="adc-cartao">   
                                <a href="../public/addCartao.php?controler=1" class="btn" id="btn-cartao">Adicionar outro</a>
                                
                            </div>
                        </div>
                        <div id="botao"><button id="confirm" >Finalizar Compra</button></div> <!-- BOTÃO FINALIZAR COMPRA -->
                    </div>
                </div>
            </form>
        
            <?php break; ?>

      <?php endswitch;?>
    </div> <!-- FIM DA DIV DOS FORMULARIOS -->
    
    <div class="resumo-compra"> <!-- RESUMO DA COMPRA -->
        <aside>
            <div class="box">
                <div class="title">Resumo da compra</div>
                <div class="conteudo">
                <div><span class="s2">Quantidade</span><span class="s1"><?= $data['cart']['totalAmount']?></span></div>
                <hr class="divisor">
                <div><span class="s2">Produtos</span><span class="s1 "><?= $data['cart']['totalItem']?></span></div>
                <hr class="divisor">
                <div><span class="s2">Frete</span><span class="s1">Grátis</span></div>
                <hr class="divisor">
                <div><span class="s2">Total</span><span class="s2 formatar-preco"><?= $data['cart']['totalPrice']?></span></div>
                </div>
            </div>
        </aside>
    </div>
</div>  <!-- FIM DA DIV CONTEUDO DA PAGINA -->


   

<script src="../assets/js/sale/finalizar-compra.js"></script>
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->


</body>
</html>
                