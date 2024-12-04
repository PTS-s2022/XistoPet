<?php

use app\libs\authenticate\GoogleClient;

require_once ('../vendor/autoload.php');

session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
}

$googleClient = new GoogleClient;
$googleClient->init();
$authUrl = $googleClient->generateAuthLink();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Xisto| login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/authenticate/loginCadastro.css" />
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
  </head>

  <body>
    <div class="tudo-lo">
      <div class="left-lo">
        <h1>
          Faça login, <br />
          e entre para o nosso time
        </h1>

        <img src="../assets/css/authenticate/img/fundoLogin.png" alt="pets" class="left-img" />
      </div>

      <div class="right-lo">
        <form action="../private/verificarLogin.php" method="POST" class="card-lo" onsubmit="return validaPost()">
          <h1>L O G I N</h1>

         
          
          <div class="inputs">
            <!-- <s for="usuario">Usuário</label> -->
            <input type="text" name="email" required />
            <label for="email">Email</label>
          </div>

          <div class="inputs">
            <!-- <label for="senha">Senha</label> -->
            <input type="password" name="senha" required id="input"/>
            <label for="senha">Senha</label>
            <div id="togglePass" class="olho"><img src="../assets/css/authenticate/img/olhoFechado.png" id="olho" alt=""></div>
            
          </div>

          <div class="g-recaptcha" data-sitekey="6Lf4nI8qAAAAAOD_dYiJ5LT3L3zz12DSxaTvO1Ph"></div>
          <br/>
          
          <!-- div erro erro -->
          <?php
            if(isset($_SESSION["ERROR"])):?>
          <div class="erro">
            <div class="erro-txt">
              <span class="span-erro">
                <i class="bx bx-error"></i>

                <p> Houve um problema </p>

                <!-- <i class='bx bx-error '></i>  -->
              </span>
              <p>
                <?= $_SESSION["ERROR"]; ?>
              </p>
            </div>
          </div>
          <?php 
            unset($_SESSION["ERROR"]);
            endif; 
          ?>
          <!-- erro -->

          <div class="inputs">
            <input type="submit" name="logar" value="Logar" class="btn_lo" />
          </div>

          <div class="textos">
            <p class="termos">
              
              <a href="senhaEsqueceu.php" class="esqueceu-senha">Esqueceu a senha?</a>
            </p>
            <p class="tem-conta">
              Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
            </p>
          </div>        
          
          <div class="alinhar">
            <div class="linha1 linha"></div>
            <p>ou</p>
            <div class="linha2 linha"></div>
          </div>
          <a href="<?= $authUrl ?>" class="a-google">
          <div class="button google" >
            <img src="../assets/css/authenticate/img/google.png" alt=""/>Continuar com o Google 
          </div>
          </a>
        </form>
        <!--final do form-->


      </div>
    </div>
  </body>

<script>
"use strict";
const input = document.querySelector("#input");
const button = document.querySelector("#togglePass");
const olho = document.querySelector("#olho");
button.addEventListener('click', togglePass);

function togglePass() {
  if (input.type == "password") {
    input.type = "text";
    olho.src = "../assets/css/authenticate/img/olho.png"
  } else {
    input.type = "password";
    olho.src = "../assets/css/authenticate/img/olhoFechado.png"
  }
}


function validaPost(){
  if(grecaptcha.getResponse() != '') return true;

  alert('selecione a caixa de "não sou um robô"');
  return false;
}

</script>

</html>
