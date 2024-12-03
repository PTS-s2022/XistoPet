<?php

use app\libs\client\ClientAddress;

require_once("../vendor/autoload.php");
require_once("../config.php");

$clientAddress = new ClientAddress;


session_start();

if(!isset($_SESSION['user']['client'])){
    header("Location: index.php");
    die();
}

if(isset($_GET['controler'])){
    $_SESSION['CONTROLER'] = 1;
}

$data = [
    'switch' => 'add'
];

if(isset($_GET['address'])){
    $data = [
        'switch' => 'alter',
        'idAddress' => $_GET['address'],
        'idClient' => $_SESSION['user']['client']
    ];

    $data['address'] = $clientAddress->selectAddress($data);
    if(!$data['address']){
        header('Location: perfil.php');
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar endereço</title>
    <link rel="stylesheet" href="../assets/css/address/add-endereco.css">
    <link rel="stylesheet" href="../assets/css/address/add-endereco-reponsivo.css">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body onload="carregado()" >
  <!-- FIM DO CABEÇALHO -->
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

    <div class="principal"> <!-- INICIO DO CONTEUDO PRINCIPAL -->
         <!-- TITULO DO CONTEUDO DA PAGINA -->



    <?php switch ($data['switch']):
        case 'add': ?>
            <p class="titulo"><span>Adicionar endereço</span></p>   
            <form method="post" action="../private/verificarEndereco.php" class="adicionar-enderecos" id="div-enderecos">
                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="cep" id="CEP" required>
                        <label for="CEP">CEP</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="cidade" id="cidade" required>
                        <label for="cidade">Cidade</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="estado" id="estado" required>
                        <label for="estado">Estado</label>
                    </div>
                </div>

                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="bairro" id="bairro" required>
                        <label for="bairro">Bairro</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="logradouro" id="logradouro" required>
                        <label for="logradouro">Logradouro (Rua)</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="number" name="numero" id="numero" required>
                        <label for="numero">Número</label>
                    </div>
                </div>

                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos-no-reqired" type="text" name="complemento" id="complemento" placeholder="a">
                        <label for="complemento">Complemento <div class="opcional">*Opcional</div></label>
                    </div>
                </div>
                <input type="hidden" name="switch" value="add">
                <div class="add-endereco-div">
                    <button id="cancelar">Cancelar</button> 
                    <button class="btn-amarelo">Adicionar Endereço</button>
                </div>
            </form>
        
            <?php break; ?>
        
        <?php case 'alter': ?>
            <p class="titulo"><span>Alterar endereço</span></p>   
            <form method="post" action="../private/verificarEndereco.php" class="adicionar-enderecos" id="div-enderecos">
                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="cep" id="CEP" value="<?= $data['address']['cep'] ?>" required>
                        <label for="CEP">CEP</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="cidade" id="cidade" value="<?= $data['address']['city'] ?>" required>
                        <label for="cidade">Cidade</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="estado" id="estado" value="<?= $data['address']['state'] ?>" required>
                        <label for="estado">Estado</label>
                    </div>
                </div>

                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="bairro" id="bairro" value="<?= $data['address']['neighborhood'] ?>" required>
                        <label for="bairro">Bairro</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="text" name="logradouro" id="logradouro" value="<?= $data['address']['publicPlace'] ?>" required>
                        <label for="logradouro">Logradouro (Rua)</label>
                    </div>
                    <div class="text-box">
                        <input class="input-enderecos" type="number" name="numero" id="numero" value="<?= $data['address']['number'] ?>" required>
                        <label for="numero">Número</label>
                    </div>
                    <input type="hidden" name="idAddress" id="idAddress" value="<?= $data['idAddress'] ?>">
                    <input type="hidden" name="switch" value="alter">
                </div>

                <div class="linha">
                    <div class="text-box">
                        <input class="input-enderecos-no-reqired" type="text" name="complemento" id="complemento" value="<?php if(isset($data['address']['complement'])): echo $data['address']['complement']; endif; ?>"  placeholder="a">
                        <label for="complemento">Complemento <div class="opcional">*Opcional</div></label>

                </div>
                <div class="add-endereco-div">
                    <button id="cancelar">Cancelar</button> 
                    <button class="btn-amarelo">Alterar Endereço</button>
                </div>
            </form>
            <?php break; ?>

        <?php endswitch;?>
        <!-- adicionar endereços -->
        
     
    </div>  <!-- FIM DO CONTEUDO PRINCIPAL -->


    <div class="alert" id="alert">
        <div class="linha-alert">
            <i class='bx bx-error'></i>
            <div id="alert2"></div>
        </div>
        <div class="vazio" id="tempo"></div>
    </div>
    
<?php

require_once('../libs/footer.html');
?>
    
</body>
<script src="../assets/js/address/cep.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->


<script>
$("#CEP").mask("00000-000");
</script>

</html>