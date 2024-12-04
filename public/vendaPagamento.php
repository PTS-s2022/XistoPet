<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Realizar pagamento</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/sale/realizar-pagamento.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/sale/realizar-pagamento-responsivo.css'>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">

</head>
<body onload="Carregado()">
    <header> <!-- CABEÇALHO -->
        <nav> <!-- INFORMAÇÕES DO CABEÇALHO -->
            <a href="#" class="logo"></a> <!-- LOGO -->
            <a href="#" class="voltar"><i class='bx bx-left-arrow-circle'></i><span>Voltar para o carrinho</span></a>
        </nav>  <!-- FIM DAS INFORMAÇÕES DO CABEÇALHO -->
    </header>   <!-- FIM DO CABEÇALHO -->
    
    <div class="flex">   <!-- DIV QUE CONTÉM O CONTEUDO DA PAGINA-->
        <p class="titulo"><span>Realizar pagamento</span></p>  <!-- TITULO DO CONTEUDO DA PAGINA -->
        <div class="formularios">
            <div class="form"> <!-- FORM METODO DE PAGAMENTO -->
                <div class="info" id="verificar"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                    <div class="titulo2"><i class='bx bxs-coin-stack'></i><span>Colocar a forma de pagamento</span></div>
                    
                    <!-- Pix -->
                    <!-- <div class="metodo">
                       <div class="pix">
                        <h1 class="titulo3"><span>O QrCode irá expirar em 30 minutos</span></h1>
                        <div class="container-qrcode">
                            <img src="../assets/css/sale/imagens/qrcode.png" alt="" class="qrcode">
                        </div>
                        <div class="boleto">
                            <input type="text" name="cod-Pix" id="cod" value="03399533744613397279700000001016498780000014912" disabled>
                            <div class="buttons">
                                <button id="copy" class="btn btn-amarelo"><p id="text">Copiar código</p></button>
                            </div>
                        </div>
                       </div>
                    </div> -->

                    

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


                </div>
            </div>



            <div class="form"> <!-- FORM METODO DE PAGAMENTO -->
                <div class="info" id="verificar"> <!-- DIV QUE CONTÉM O CONTEUDO DO FORM -->
                    <div class="titulo2 no-space"><i class='bx bx-location-plus'></i><span>Destinatário: Brenno Marques da Cruz</span></div>

                    <div class="entrega">
                        <div class="titulo3"><span>Entrega padrão</span></div>
                        <div class="text-entrega">Entrega prevista para dia 30/10</div>
                    </div>
                    <div class="produtos">
                        
                    </div>
                </div>
            </div>




        </div>
        
        <div class="resumo-compra"> <!-- RESUMO DA COMPRA -->
            <aside>
                <div class="box">
                    <div class="title">Resumo da compra</div>
                    <div class="conteudo">
                    <div><span class="s1">Quantidade</span><span class="s1">2 itens</span></div>
                    <hr class="divisor">
                    <div><span class="s2">Subtotal</span><span class="s2 formatar-preco">270.00</span></div>
                    <hr class="divisor">
                    <div><span class="s1">Frete</span><span class="s1">Grátis</span></div>
                    <hr class="divisor">
                    <div><span class="s2">Total</span><span class="s2 formatar-preco">240.00</span></div>
                    </div>
                </div>
            </aside>
        </div>

</body>
<script src='../assets/js/sale/realizar-pagamento.js'></script>
</html>