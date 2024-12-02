<?php
session_start();


if(!isset($_SESSION['usuario'])){
  $_SESSION['CONTROL'] = "notificacoes";
  header("Location: login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<a href="index.php"><h3>index</h3></a><br>
  Suas notificações<br><br>

<?php

require_once("../libs/config.php");

//conectando com banco de dados
$bd = new PDO("mysql:host=" . MYSQL_HOST.";dbname=".MYSQL_DATA, MYSQL_USER, MYSQL_PASS  );

//selecionando o id do usuario
$usuario = $bd->prepare("SELECT id FROM tb_usuario WHERE email = :email");
$usuario->execute(
  [
    ":email" => $_SESSION['usuario']
  ]
);
$usuario = $usuario->fetch();

//selecionando o id da pessoa
$pessoa = $bd->prepare("SELECT * FROM tb_pessoa WHERE usuario = :usuario");
$pessoa->execute(
  [
    ":usuario" => $usuario['id'],
  ]
);
$pessoa = $pessoa->fetch();

//selecionando o id das notificações

$notificacoes = $bd->prepare("SELECT * FROM tb_notificacao WHERE pessoa = :pessoa");
$notificacoes->execute(
  [
    ":pessoa" => $pessoa['id']
  ]
);
if($notificacoes->rowCount() == 0){
  echo "voce ainda não possui uma notificação!";
  die();
}

$notificacoes = $notificacoes->fetchAll();


?>
<?php foreach ($notificacoes as $notificacao) :?>
  <a href="notificacao.php?notificacao=<?= $notificacao['id']?>">
    Recebida em <?= $notificacao['data'] ?><br>
    <?php 
      $tipoNotificacao = $bd->prepare("SELECT * FROM tb_tipo_notificacao WHERE id = :tipo");
      $tipoNotificacao->execute(
        [
          ":tipo" => $notificacao['tipo'],
        ]
       );
      $tipoNotificacao = $tipoNotificacao->fetch();
    ?>
   <?= $tipoNotificacao['tipo'] ?><br><br>
  </a>
<?php endforeach; ?>
</body>
</html>