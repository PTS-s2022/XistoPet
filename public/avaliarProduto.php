<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produto</title>
  
  <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">
</head>
<body>
    <!-- aqui é quando der erro, coloque o value=1 para aparecer o erro -->
    <input type="hidden" name="inputErro" id="entrada-erro" value="1">
    <dialog id="erro">
        <h1 class="titulo-erro">Dados incorretos</h1>
        <div>
            <p class="p-erro">Preencha todos os campos corretamente</p>
        </div>
        <div class="div-btn-erro">
            <button id="fechar">Fechar</button>
        </div>
    </dialog>

<a href="index.php"><h3>index</h3></a><br>
<?php
  if(isset($_SESSION["ERRORAVALIAR"])){
    echo $_SESSION["ERRORAVALIAR"];
    unset($_SESSION["ERRORAVALIAR"]);
  }
?>
<h3>Avaliar Produto</h3>
  <form action="../private/verificarAvaliarProduto.php" method="POST">
  Estrelas:<br>
  <input type="number" name="qualidade" id="qualidade"><br><br>
  Comentários:<br>
  <input type="text" name="comentario" id="comentario"><br><br>
  <input type="hidden" name="itemVenda" value="<?= $_GET['itemVenda']?>">
  <input type="submit" value="Avaliar">
  </form>
</body>
<script src='../assets/js/error/erro.js'></script>  <!-- script do erro -->

</html>