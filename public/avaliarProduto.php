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
  <title>Login</title>
</head>
<body>
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
</html>