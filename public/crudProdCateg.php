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
session_start();
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
else{
  header("Location: index.php");
  die();
}

// verifica se o usuario é adiministrador
if($usuario['tipo'] != "A" && $usuario['tipo'] != "ADM") {
  header("Location: index.php");
  die();
}
?>
Categória<br>
<a>Criar</a><a>Alterar</a>

</body>
</html>