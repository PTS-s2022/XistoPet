<?php
session_start();
if(isset($_SESSION['usuario'])){
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Xisto| cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/authenticate/loginCadastro.css"/>
    <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>

  <body>
    <div class="tudo-lo">
      <div class="left-lo">
        <h1>
          Faça Cadastro, <br />
          e entre para o nosso time
        </h1>

        <img src="../assets/css/authenticate/img/fundoLogin.png" alt="pets" class="left-img" />
      </div>

      <div class="right-lo">
        <form action="../private/verificarCadastro.php" method="POST" class="card-lo" onsubmit="return validaPost()">
          <h1>C A D A S T R O</h1>
          
          <div class="inputs">
            <!-- <s for="usuario">Usuário</label> -->
            <input type="text" name="nome" required />
            <label for="nome">Nome completo</label>
          </div>

          <div class="inputs">
            <!-- <s for="usuario">Usuário</label> -->
            <input type="text" name="email" required />
            <label for="email">Email</label>
          </div>

          <div class="inputs">
            <!-- <label for="senha">Senha</label> -->
            <input type="password" name="senha" required id="input" />
            <label for="senha">Senha</label>
            <div id="togglePass" class="olho"><img src="../assets/css/authenticate/img/olhoFechado.png"  id="olho" alt=""></div>
            
          </div>
          <div class="inputs">
            <!-- <label for="repsenha">RepetirSenha</label> -->
            <input type="password" name="senhaRep" id="inputRep" required/>
            <label for="repSenha">Repetir senha</label>
            <div id="togglePassRep" class="olho"><img src="../assets/css/authenticate/img/olhoFechado.png" id="olhoRep" alt=""></div>
            
          </div>

          <div class="g-recaptcha" data-sitekey="6Lf4nI8qAAAAAOD_dYiJ5LT3L3zz12DSxaTvO1Ph"></div>
          <br/>

          <?php if(isset($_SESSION["ERROR"])):?>
          <!-- div erro erro -->
            <div class="erro">
              <div class="erro-txt">
                <span class="span-erro">
                  <i class="bx bx-error"></i>

                  <p>Houve um problema</p>
                  <!-- <i class='bx bx-error '></i>  -->
                </span>
                <p>
                  <?= $_SESSION["ERROR"];?>
                </p>
              </div>
            </div>
          <?php 
            unset($_SESSION["ERROR"]);
          endif; 
          ?>
          <!-- erro -->

          <div class="inputs">
            <input
              type="submit"
              name="Cadastrar"
              value="Cadastrar"
              class="btn_lo"
            />
          </div>

          <div class="textos">
            <p class="termos">
              Ao clicar em “Cadastrar” ou “Continuar com o Google”, você
              concorda com os <a href="">Termos de Serviço</a> e a
              <a href="">Política de Privacidade</a> da Xistopet.
            </p>
            <p class="tem-conta">
              Já tem uma conta? <a href="login.php">Faça login</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>

<script>
"use strict";
var input = document.querySelector("#input");
var inputRep = document.querySelector("#inputRep");
var button = document.querySelector("#togglePass");
var buttonRep = document.querySelector("#togglePassRep");
var olho = document.querySelector("#olho");
var olhoRep = document.querySelector("#olhoRep");

button.addEventListener('click', function () {
  if (input.type == "password") {
    input.type = "text";
    olho.src = "../assets/css/authenticate/img/olho.png"
  } else {
    input.type = "password";
    olho.src = "../assets/css/authenticate/img/olhoFechado.png"
  }
});



buttonRep.addEventListener('click', function () {
  if (inputRep.type == "password") {
    inputRep.type = "text";
    olhoRep.src = "../assets/css/authenticate/img/olho.png"
  } else {
    inputRep.type = "password";
    olhoRep.src = "../assets/css/authenticate/img/olhoFechado.png"
  }
});

function validaPost(){
  if(grecaptcha.getResponse() != '') return true;

  alert('selecione a caixa de "não sou um robô"');
  return false;
}


</script>

</html>