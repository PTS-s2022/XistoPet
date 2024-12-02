<?php
session_start();
if(!isset($_SESSION['user'])){
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<a href="index.php"><h3>index</h3></a><br>
<?php
  if(isset($_SESSION["ERROREND"])){
    echo $_SESSION["ERROREND"];
    unset($_SESSION["ERROREND"]);
  }
?>
  <h3>Endereço</h3>
  <form action="../private/verificarEndereco.php" method="POST">
  Nome:<br>
  <input type="text" name="nome" id="nome" ><br><br>
  Cep:<br>
  <input type="text" name="cep" id="cep" ><br><br>
  Estado:<br>
  <input type="text" name="estado" id="estado" ><br><br>
  Cidade:<br>
  <input type="text" name="cidade" id="cidade" ><br><br>
  Bairro:<br>
  <input type="text" name="bairro" id="bairro" ><br><br>
  Logradouro:<br>
  <input type="text" name="logradouro" id="logradouro" ><br><br>
  Número:<br>
  <input type="text" name="numero" id="numero" ><br><br>
  Complemento:<br>
  <input type="text" name="complemento" id="complemento" ><br><br>
  <input type="submit" value="Cadastrar">
  </form>
</body>
</html>