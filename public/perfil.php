<?php

use app\libs\admin\Admin;
use app\libs\client\Client;

require_once("../vendor/autoload.php");
require_once("../config.php");


$client = new Client;
$admin = new Admin;

session_start();

if(!isset($_SESSION['user'])){
  header("Location: login.php");
  die();
}
$data['nivel'] = $_SESSION['user']['nivel'];


switch ($data['nivel']) {
    case '1':
        $data['idClient'] = $_SESSION['user']['client'];
        
        $data['client'] = $client->displayClient($data);
        
        $data['client']['favorite'] = $client->dataClientFavorite($data);
        
        $data['user'] = [
            'email' =>  $_SESSION['user']['email'],
            'name' => $data['client']['name'],
            'cpf' => $data['client']['cpf'],
            'phone' => null,
        ];

        break;
    
    default:
        $data['idAdmin'] = $_SESSION['user']['admin'];
        $data['admin'] = $admin->displayAdmin($data);

        $data['user'] = [
            'email' =>  $_SESSION['user']['email'],
            'name' => $data['admin']['name'],
            'cpf' => $data['admin']['cpf']
        ];

        break;

}

?>
<!DOCTYPE html>
<html lang="pt-br" id="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/profile/perfil.css">
    <link rel="stylesheet" href="../assets/css/profile/perfil-responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
</head>
<body onload="carregado()" id="body">
    <div class="all" id="all"> <!-- Div que aparece quando a pessoa clica em limpar carrinho -->
        <div class="confirmar">
            <p class="titulo"><span>Sair da conta</span></p>
            <p class="texto">Tem certeza que deseja sair?</p>
            <p class="texto">Após a confirmação você será deslogado</p>
            <div class="confirmacao">
                <a href="logout.php" class="sair"><button>Confirmar</button></a> <!-- aqui vai o php pra limpar a session -->
                <a id="cancelar"  class="cancelar"><button>Cancelar</button></a>
            </div>
        </div>
    </div>
 
    <div id="blur">
<?php
  require_once('../libs/header.php');
?> 
<div class="principal"> <!-- INICIO DO CONTEUDO PRINCIPAL -->

    <div class="main">
        <main>  <!-- LINKS DAS INFORMAÇÕES DO CLIENTE -->
            <h1 id="h1">Olá, <?= $data['user']['name'] ?></h1>
            <ul>
                <li id="ir-dados-pessoais"><a class="item"><img src="../assets/css/profile/icones/dog-13-svgrepo-com.svg"  id="img">Meus Dados</a></li><br>
                <?php if ($data['nivel'] == 1) :?>
                    <li id="ir-pedidos"><a class="item" href="../public/pedidos.php"><img src="../assets/css/profile/icones/box-svgrepo-com.svg"  id="img">Meus Pedidos</a></li><br>
                    <li id="ir-cartoes"><a class="item"><img src="../assets/css/profile/icones/card-svgrepo-com.svg"  id="img">Meus Cartões</a></li><br>
                    <li id="ir-favoritos"><a class="item"><img src="../assets/css/profile/icones/heart-svgrepo-com.svg"  id="img">Favoritos</a></li><br>
                    <li id="ir-enderecos"><a class="item"><img src="../assets/css/profile/icones/house-chimney-floor-svgrepo-com.svg"  id="img">Meus Endereços</a></li><br>
                <?php else:?>
                    <li><a class="item" href="../public/produtoGerenciar.php"><img src="../assets/css/profile/icones/box-svgrepo-com.svg" id="img">Gerenciar Produtos</a></li><br>
                    <li><a class="item" href="../public/vendaGerenciar.php"><img src="../assets/css/profile/icones/box-svgrepo-com.svg" id="img">Gerenciar Pedidos</a></li><br>
                    <li><a class="item" href="../public/fornecedorGerenciar.php"><img src="../assets/css/profile/icones/box-svgrepo-com.svg" id="img">Gerenciar Fornecedor</a></li><br>
                    <?php if($data['nivel'] == 3):?>
                        <li><a class="item" href="../public/adminGerenciar.php"><img src="../assets/css/profile/icones/box-svgrepo-com.svg" id="img">Gerenciar Admintradores</a></li><br>
                    <?php endif;?>
                <?php endif;?>
                <div><a class="item" href="../public/senhaAlterar.php"><img src="../assets/css/profile/icones/edit-solid-24.png" id="img">Alterar Senha</a></div><br>
                <li><a id="sair" class="item"><img src="../assets/css/profile/icones/logout-svgrepo-com.svg"  id="img">Sair</a></li><br>
            </ul>
        </main>
    </div>

    <div class="information">
        <form action="" method="get" class="info" id="dados-pessoais">  <!-- INFORMAÇÕES PESSOAIS -->
            <h2>Meus Dados</h2>
            <p>E-mail:</p>
            <p class="dados"><?= $data['user']['email']  ?></p>
            <p>Nome:</p>
            <p class="dados"><?= $data['user']['name'] ?></p>
            <p>CPF:</p>
            <p class="dados cpf" id="cpf"><?php if(isset($data['user']['cpf'])): echo $data['user']['cpf']; endif;  ?></p>
            <!-- <div class="div-button" id="editar-dados">Editar Dados</div> -->
        </form>

        <!-- CARTÕES -->
        <?php if(isset($data['client'])):?> 
            <div class="info" id="cartoes">
            <h2>Meus Cartões</h2>
                <?php if(!$data['client']['card']):?>
                    
                    <p id="msgm">Você ainda não tem cartões cadastrados</p>
                <?php else: ?>

                    <?php foreach ($data['client']['card'] as $k => $card): ?>
                        <div class="adress">
                            <div class="p">
                                <p class="titulo-a"><?= $card->nomeTitular ?></p>
                                <p class="sub-a" id="cartao"><?= $card->numero ?></p>
                            </div>
                            <div class="icones">
                                <a href="../private/verificarCartao.php?card=<?= $card->id ?>"><i class='bx bx-trash'></i></a> 
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>
                <a href="../public/addCartao.php"><button>Adicionar Cartão</button></a>
            </div>

            <!-- FAVORITOS -->
                
            <div class="info" id="favoritos">
            <h2>Favoritos</h2>
                <?php if(!$data['client']['favorite']):?>
                    
                    <p id="msgm">Você ainda não tem itens favoritados</p>
                
                <?php else: ?>
                    <div class="favoritos">
                        <?php foreach ($data['client']['favorite'] as $k => $favorite): ?>                           
                            <div class="products"> <!-- PRODUTO -->
                                <a href="../private/verificarFavoritos.php?product=<?= $favorite['product']['id'] ?>&&switch=profile" class="lixeira"><i class='bx bx-trash'></i></a>
                                <div class="img-products"><img src="../imagem/<?= $favorite['product']['image'] ?>" ></div>
                                <p class="nome-p"><?= $favorite['product']['name'] ?></p>
                                <div class="preco-flex">
                                    <p class="preco formatar-preco"><?= $favorite['product']['price']['min']?></p>
                                    <p class="traco">-</p>
                                    <p class="preco formatar-preco"><?= $favorite['product']['price']['max']?></p>
                                </div>
                                <a class="btn-adic" href="produto.php?idProduct=<?= $favorite['product']['id'] ?>"><button class="nada-branco">Visualizar</button></a>
                            </div>   
                        <?php endforeach;?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- DIV ENDEREÇOS -->
            <div class="info" id="enderecos">
                <h2>Meus Endereços</h2>    
                <?php if(!$data['client']['address']):?>
                    
                    <p id="msgm">Você não posssui endereços cadastrados</p>
                <?php else: ?>
                    <?php foreach ($data['client']['address'] as $k => $address): ?>
                        <div class="adress">
                        <div class="p">
                            <p class="titulo-a"><?= $address->logradouro ?>, <?= $address->numero ?></p>
                            <p class="sub-a"><?= $address->cidade ?>, <?= $address->estado ?></p>
                        </div>
                        <div class="icones">
                            <a href="addEndereco.php?address=<?= $address->id?>"><i class='bx bx-edit-alt'></i></a>
                            <a href="../private/verificarEndereco.php?address=<?= $address->id?>"><i class='bx bx-trash'></i></a>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif; ?>
                <a href="../public/addEndereco.php"><button>Adicionar Endereço</button></a>
            </div>
        <?php endif; ?>
    </div>


</div>  <!-- FIM DO CONTEUDO PRINCIPAL -->


        

    </div>
        <?php
            require_once('../libs/footer.php');
        ?>

    
</body>
<script src="../assets/js/profile/perfil.js"></script>
<!-- <script src="menu.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

<script>
$("#CEP").mask("00000-000");
$(".cpf").mask("000.000.000-00");
$("#cartao").mask("0000 0000 0000 0000");
$('.telefone').mask('(00) 00000-0000');
                        
</script>

</html>