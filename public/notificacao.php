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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="index.php"><h3>index</h3></a><br>
<?php
require_once("../libs/config.php");

$bd = new PDO("mysql:host=" . MYSQL_HOST.";dbname=".MYSQL_DATA, MYSQL_USER, MYSQL_PASS  );

//Verificando se essa notificação existe e se é desse usuário
$veriNotificacao = $bd->prepare("SELECT * FROM tb_notificacao WHERE id = :id");
$veriNotificacao->execute(
    [
    ":id" => $_GET['notificacao'],
    ]
);
$notificacao = $veriNotificacao->fetch();

if($veriNotificacao->rowCount() == 0)
{
  header("Location: index.php");
  die();
}

switch ($notificacao['tipo']) {  
  case '1':
    ?>
    avalie o produto
    <a href='avaliarProduto.php?itemVenda=<?= $notificacao['itemVenda'] ?>'>avalie</a>
    <?php
    break;
  case '2':
    ?>
      produto
    <?php
    break;
  default:
    # code...
    break;
}   
?>

</body>
</html>
