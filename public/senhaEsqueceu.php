<?php

session_start();
if(isset($_SESSION['user'])){
  header("Location: ../public/index.php");
}

$switch = 'email';

if(isset($_GET['switch'])){

        if(!$_GET['email']){
            header("Location: ../public/senhaEsqueceu.php");
        }
        $data['email'] = $_GET['email'];
        $switch = 'token';
}


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


        
<?php switch ($switch):
    case 'email':?>

    <div class="right">

        <form action="../private/verificarSenhaEsqueceu.php" method="POST" class="card-lo">

            <h1>EMAIL DE RECUPERAÇÃO</h1>


            <div class="textos">
                <p class="tem-conta">Perdeu o acesso a sua conta? digite seu email para redefinir.</p> 
            </div>

            <div class="inputs">
                <!-- <s for="usuario">Usuário</label> -->
                <input type="text" name="email" required />
                <label for="email">Email</label>
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
                
                <input type="submit" name="senha" value="Enviar" class="btn_lo" />
                
            </div>
            
            <div class="textos">
                <p class="tem-conta">Não deseja mais redefiner a senha? <a href="login.php">voltar</a></p>
            </div>      

        </form> <!--final do form-->
    </div>
<?php break; 
    case 'token': ?>    

        

    <div class="right">

        <form action="../private/verificarSenhaEsqueceu.php" method="POST" class="card-lo">

            <h1>CÓDIGO DE RECUPERAÇÃO</h1>
            

            <div class="textos">
                <p class="tem-conta">Insira o código que você recebeu em seu emal para realizar a troca da senha</p> 
            </div>

            <div class="inputs">
                <!-- <s for="usuario">Usuário</label> -->
                <input type="text" name="token" required />
                <label for="token">Código</label>
                <input type="hidden" name="email" value='<?= $data['email']?>'>
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
                
                <input type="submit" name="senha" value="Enviar" class="btn_lo"/>
                
            </div>
            
            <div class="textos">
                <p class="tem-conta">O código foi enviado para seus email <!-- <a href="#">senha</a>--></p>
            </div>



            

        </form> <!--final do form-->

    </div>

</div>

<?php break;
    endswitch;?>


</body>



</html>