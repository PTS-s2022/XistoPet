<?php
session_start();

if(isset($_SESSION['user'])){
  header("Location: index.php");
}

if(!$_GET['email'] || !$_GET['token']){
    header("Location: ../public/senhaEsqueceu.php");
}
$data['email'] = $_GET['email'];
$data['token'] = $_GET['token'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Xisto| email de recuperação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets\css\alterPassword\senha.css" />

</head>

<body>


    <div class="tudo-lo">

<div class="right">

    <form action="../private/verificarSenhaEsqueceu.php" method="POST" class="card-lo">

        <h1>TROCAR SENHA</h1>

        
       


        <div class="inputs">
            <!-- <label for="senha">Senha</label> -->
            <input type="password" name="passwordNew" class="senha" required />
            <label for="senha">Nova senha</label>
            <div class="olho"><img src="../assets\css\alterPassword\imagens\olhoFechado.png" alt="" class="img-olho"></div>
        </div>
 

        <div class="inputs">
            <!-- <label for="senha">Senha</label> -->
            <input type="password" name="passwordNewVerify" class="senha" required />
            <label for="senha">repetir nova senha</label>
            <div class="olho"><img src="../assets\css\alterPassword\imagens\olhoFechado.png" alt="" class="img-olho"></div>

        </div>
        <input type="hidden" name="email" value='<?= $data['email']?>'>
        <input type="hidden" name="token" value='<?= $data['token']?>'>
        <?php
            if(isset($_SESSION["ERROR"])):?>
                <div class="erro">
                    <div class="erro-txt">
                    <span class="span-erro">
                        <i class="bx bx-error"></i>

                        <p> Houve um problema </p>

                        <i class='bx bx-error '></i> 
                    </span>
                    <p>
                        <?= $_SESSION["ERROR"] ?>
                    </p>
                    </div>
                </div>
            <?php 
                unset($_SESSION["ERROR"]);
                endif; 
            ?>
        <div class="inputs">
        
            <input type="submit" name="senha" value="trocar" class="btn_lo" />

        </div>




        <div class="textos">

            <p class="tem-conta">Não deseja mais redefiner a senha? <a href="../public/login.php">voltar
            </a></p>
        </div>

    </form> <!--final do form-->

</div>
</div>



<script src="..\assets\js\alterPassword\alterarsenha.js"></script>
</body>


</html>