<?php
session_start();
if(!isset($_SESSION['user'])){
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Xisto| cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets\css\alterPassword\senha.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets\css\authenticate\loginCadastro.css" />
</head>

<body>
    <div class="tudo-lo">



        <div class="right">

            <form action="../private/verificarSenhaAlterar.php" method="POST" class="card-lo">

                <h1>TROCAR SENHA</h1>

                <div class="inputs">
                    <!-- <s for="usuario">Usuário</label> -->
                    <input type="password" name="password" class="senha" required />
                    <label for="usuario">Senha atual</label>
                    <div class="olho"><img src="../assets\css\alterPassword\imagens\olhoFechado.png" alt="" class="img-olho"></div>


                </div>
               

                <div class="textos">

                    <p class="tem-conta">Digite sua nova senha <!-- <a href="#">senha</a>--></p> 
                </div>


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

                    <p class="tem-conta">Não deseja mais redefiner a senha? <a href="perfil.php">voltar
                    </a></p>
                </div>

            </form> <!--final do form-->

        </div>
    </div>




</body>

<script src="..\assets\js\alterPassword\alterarsenha.js"></script>

</html>