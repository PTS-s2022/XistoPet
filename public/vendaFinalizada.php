<?php

use app\libs\sale\Sale;

require_once("../vendor/autoload.php");
require_once("../config.php");
require_once("../bug/phpMailer/Payload.php");

$sale = new Sale;

session_start();

if(!isset($_SESSION['user']['client'])){
  header("Location: index.php");
  die();
}

$data = [
  'idClient' => $_SESSION['user']['client'],
  'idSale' => $_GET['idSale']
];

$data['sale'] = $sale->payment($data);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar pagamento</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/sale/realizar-pagamento.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/sale/realizar-pagamento-responsivo.css'>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3d2ec5edb8.js" crossorigin="anonymous"></script>
</head>

<body onload="carregado()">
<header> <!-- CABEÇALHO -->
    <nav> <!-- INFORMAÇÕES DO CABEÇALHO -->
        <a href="#" class="logo"></a> <!-- LOGO -->
        <a href="../public/carrinho.php" class="voltar"><i class='bx bx-left-arrow-circle'></i><span>Voltar para o carrinho</span></a>
    </nav>  <!-- FIM DAS INFORMAÇÕES DO CABEÇALHO -->
</header>   <!-- FIM DO CABEÇALHO -->

    <div class="flex">   <!-- DIV QUE CONTÉM O CONTEUDO DA PAGINA-->
        <p class="titulo"><span>Realizar pagamento</span></p>  <!-- TITULO DO CONTEUDO DA PAGINA -->
        <div class="formularios">
            <div class="form"> <!-- FORM METODO DE PAGAMENTO -->
                <div class="info" id="verificar"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                    <div class="titulo2"><i class='bx bxs-coin-stack'></i><span>Forma de pagamento</span></div>
                    <?php switch ($data['sale'][0]->metodo):
                        case '1': ?>
                            <!-- Pix -->
                            <div class="metodo">
                            <div class="pix">
                                <h1 class="titulo3"><span>O QrCode irá expirar em 30 minutos</span></h1>
                                <div class="container-qrcode">
                                    <img src="data:image/png;base64,<?= base64_encode($data['sale'][0]->pix['image'])?>" alt="" class="qrcode">
                                </div>
                                <div class="boleto">
                                    <input type="text" name="cod-Pix" id="cod" value="<?= $data['sale'][0]->pix['key']?>" disabled>
                                    <div class="buttons">
                                        <button id="copy" class="btn"><p id="text">Copiar código</p></button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <?php break; ?>
                        
                        <?php case '2': ?>
                            <!-- Boleto -->
                            <div class="metodo">
                                <div class="boleto">
                                    <input type="text" name="cod-boleto" id="cod" value="03399533744613397279700000001016498780000014912" disabled>
                                    <div class="buttons">
                                        <button id="copy"><p id="text">Copiar código</p></button>
                                        <button class="btn">Salvar boleto</button>
                                    </div>
                                    <div class="prazo">
                                        <p>O prazo para o pagamento do boleto é de até 2 dias úteis</p>
                                    </div>
                                </div>
                            </div>
                            <?php break; ?>


                    <?php endswitch;?>
                    

                    

                    


                </div>
            </div>



            <!-- <div class="form">--> <!-- FORM METODO DE PAGAMENTO -->
            <!--     <div class="info" id="verificar">--> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
            <!--         <div class="titulo2 no-space"><i class='bx bx-location-plus'></i><span>Destinatário: Brenno Marques da Cruz</span></div>

                    <div class="entrega">
                        <div class="titulo3"><span>Entrega padrão</span></div>
                        <div class="text-entrega">Entrega prevista para dia 30/10</div>
                    </div>
                    <div class="produtos">
                        
                    </div>
                </div>
            </div> -->




        </div>
    
    <div class="resumo-compra"> <!-- RESUMO DA COMPRA -->
        <aside>
            <div class="box">
                <div class="title">Resumo da compra</div>
                <div class="conteudo">
                <div><span class="s2">Quantidade</span><span class="s1"><?= $data['sale']['totalAmount']?></span></div>
                <hr class="divisor">
                <div><span class="s2">Produtos</span><span class="s1"><?= $data['sale']['totalItem']?></span></div>
                <hr class="divisor">
                <div><span class="s2">Frete</span><span class="s1">Grátis</span></div>
                <hr class="divisor">
                <div><span class="s2">Total</span><span class="s2 formatar-preco"><?= $data['sale']['totalPrice']?></span></div>
                </div>
            </div>
        </aside>
    </div>
</div>  <!-- FIM DA DIV CONTEUDO DA PAGINA -->
   

<script src="../assets/js/sale/realizar-pagamento.js"></script>

</body>
</html>
                



