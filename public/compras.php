<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<a href="index.php"><h3>index</h3></a><br>
  Suas compras<br><br>

<?php
session_start();
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

//selecionando o id do carrinho

$vendas = $bd->prepare("SELECT * FROM tb_venda WHERE pessoa = :pessoa AND status = :statusA OR  pessoa = :pessoa AND status = :statusC OR pessoa = :pessoa AND status = :statusE ");
$vendas->execute(
  [
    ":pessoa" => $pessoa['id'],
    ":statusA" => "C",
    ":statusC" => "A",
    ":statusE" => "E"
  ]
);
if($vendas->rowCount() == 0){
  echo "voce ainda não ralizou nenhuma compra";
  die();
}

$vendas = $vendas->fetchAll();


?>
<?php foreach ($vendas as $venda) :?>
  Realizada em <?= $venda['dataVenda'] ?><br>

  <?php 
    $itensVenda = $bd->prepare("SELECT * FROM tb_item_venda WHERE venda = :venda");
    $itensVenda->execute(
      [
        ":venda" => $venda['id'],
      ]
    );
    $itensVenda = $itensVenda->fetchAll();
  ?>

    <?php foreach ($itensVenda as $itemVenda) :?>
      
      <?php 
        $produto = $bd->prepare("SELECT nome FROM tb_produto  WHERE id = :produto");
        $produto->execute(
          [
            ":produto" => $itemVenda['produto'],
          ]
        );
        $produto = $produto->fetch();
      
        $estoque = $bd->prepare("SELECT qtd FROM tb_estoque_produto WHERE produto = :produto");
        $estoque->execute(
            [
            ":produto" => $itemVenda['produto'],
            ]
        );
        $estoque = $estoque->fetch();
      
      ?>
      <b><?= $produto['nome']?></b></br>
      Quantidade:<?= $itemVenda['qtd']?>
      Preço: R$<?= $itemVenda['subTotal']?><br>
    <?php endforeach;?><br><br>
<?php endforeach; ?>
</body>
</html>