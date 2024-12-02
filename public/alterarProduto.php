<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="index.php"><h3>index</h3></a><br>
<?php
require_once("../libs/config.php");

$bd = new PDO("mysql:host=" . MYSQL_HOST.";dbname=".MYSQL_DATA, MYSQL_USER, MYSQL_PASS  );

if(isset($_SESSION["usuario"])) {
  $usuario = $bd->prepare("SELECT tipo FROM tb_usuario WHERE email = :email");
  $usuario->execute(
    [
      ":email" => $_SESSION["usuario"],
    ]
  );
  $usuario = $usuario->fetch(PDO::FETCH_ASSOC);
}

// verifica se o usuario é adiministrador
if($usuario['tipo'] != "A" && $usuario['tipo'] != "ADM") {
  header("Location: index.php");
  die();
}
//Verificando se esse produto existe
$veriProduto = $bd->prepare("SELECT * FROM tb_produto WHERE id = :id");
$veriProduto->execute(
    [
    ":id" => $_GET['produto'],
    ]
);
$produto = $veriProduto->fetch();

if($veriProduto->rowCount() == 0)
{
  header("Location: index.php");
  die();
}

//Verificando se o estoque não esta vazio
$veriEstoque = $bd->prepare("SELECT qtd FROM tb_estoque_produto WHERE produto = :produto");
$veriEstoque->execute(
    [
    ":produto" => $_GET['produto'],
    ]
);
$estoque = $veriEstoque->fetch();

if(isset($_SESSION['ERROR'])){
  echo $_SESSION['ERROR'];
  unset($_SESSION['ERROR']);
}
?>    

<form action="../private/verificarAlterarProduto.php" method="POST">
  <input type="hidden" name="produto" value="<?= $produto['id']?>">
  Categória: <input type="number" name="categoria" value="<?= $produto['categoria']?>"><br><br>
  Nome: <b><input type="text" name="nomeProduto" value="<?= $produto['nome']?>"></b><br>
  <img src="<?= $produto['img']?>">
  <br>
  Descrição: <input type="text" name="descricaoProduto" value="<?= $produto['descricao']?>"><br>

  <?= $estoque['qtd']?> disponíveis<br>
  Preço unitario: <input type="text" name="preco" value="<?= $produto['preco']?>"><br>
  <input type="submit" value="alterar">

</form>






</body>
</html>