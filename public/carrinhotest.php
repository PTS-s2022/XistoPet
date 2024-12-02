<?php

require_once("../vendor/autoload.php");
require_once("../config.php");

session_start();


if(!isset($_SESSION['usuario'])){
  $_SESSION['CONTROL'] = "carrinho";
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
$idUsu = $usuario->fetch();

//selecionando o id da pessoa
$pessoa = $bd->prepare("SELECT id FROM tb_pessoa WHERE usuario = :usuario");
$pessoa->execute(
  [
    ":usuario" => $idUsu['id'],
  ]
);
$idPes = $pessoa->fetch();

//selecionando o id do carrinho
$venda = $bd->prepare("SELECT id FROM tb_venda WHERE pessoa = :pessoa AND status = :status");
$venda->execute(
  [
    ":pessoa" => $idPes['id'],
    ":status" => "O"
  ]
);

//se não existir uma venda inicializada ira iniciar uma

if($venda->rowCount() == 0){
  $insertVen = $bd->prepare("INSERT INTO tb_venda (pessoa) VALUES (:pessoa)");
  $insertVen->execute(
    [
      ":pessoa" => $idPes['id']
    ]
  );
  $venda = $bd->prepare("SELECT id FROM tb_venda WHERE pessoa = :pessoa AND status = :status");
  $venda->execute(
    [
      ":pessoa" => $idPes['id'],
      ":status" => "O"
    ]
  );

}

$idVen = $venda->fetch();



//selecionando os produtos do carrinho
$selectItensVenda = $bd->prepare("SELECT * FROM tb_item_venda WHERE venda = :venda");
$selectItensVenda->execute(
  [
    ":venda" => $idVen['id'],
  ]
);
$itensVenda = $selectItensVenda->fetchAll();

foreach ($itensVenda as $itemVenda)
{
  $produto = $bd->prepare("SELECT preco FROM tb_produto  WHERE id = :produto");
  $produto->execute(
    [
      ":produto" => $itemVenda['produto'],
    ]
  );
  $produto = $produto->fetch();
        
  //
  $veriEstoque = $bd->prepare("SELECT qtd FROM tb_estoque_produto WHERE produto = :produto");
  $veriEstoque->execute(
      [
      ":produto" => $itemVenda['produto'],
      ]
  );
  $estoque = $veriEstoque->fetch();

  if($estoque['qtd'] < $itemVenda['qtd']){
    $atuEstoque = $bd->prepare("UPDATE tb_item_venda SET qtd = :qtd, subTotal = :subTotal WHERE venda = :venda AND id = :id");
    $atuEstoque->execute(
        [
        ":venda" => $idVen['id'],
        ":id" => $itemVenda['id'],
        ":qtd" => $estoque['qtd'],
        ":subTotal" => $produto['preco'] * $estoque['qtd']
        ]
    );   
  }
   
}
$itensVenda = $bd->prepare("SELECT * FROM tb_item_venda WHERE venda = :venda");
$itensVenda->execute(
  [
    ":venda" => $idVen['id'],
  ]
);
$itensVenda = $itensVenda->fetchAll();
$total = 0;
?>

<tr>
    <td><h3>Produtos do carrinho</h3></td>
  </tr>
  <tr>
  <?php foreach ($itensVenda as $itemVenda) :?>
    <td>   
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
      <b><?= $produto['nome']?></b>
      </br>
      <?php if($estoque['qtd'] > 0):?>
        Quantidade: 
          <a href="../private/alterarProdCarrinho.php?id=<?= $itemVenda['id']?>&quantidade=<?= $itemVenda['qtd']?>&alterar=retirar">-</a>
            <?= $itemVenda['qtd']?>
          <a href="../private/alterarProdCarrinho.php?id=<?= $itemVenda['id']?>&quantidade=<?= $itemVenda['qtd']?>&alterar=adicionar">+</a><br>
        <?= $estoque['qtd']?> disponíveis<br>
        Preço: R$<?= $itemVenda['subTotal']?><br>
      <?php else:?>
        indisponivel<br>
      <?php endif;?>
      <a href="../private/alterarProdCarrinho.php?id=<?= $itemVenda['id']?>&alterar=excluir">Excluir</a>

      <?php 
        $total += $itemVenda['subTotal'];
      ?>
    </td> <br><br>
  <?php endforeach;?>
  </tr>
  <input type="button" value="Finalizar compra" onclick='location.replace("../private/verificarVenda.php?switch=produto")'>
  <b>Total: R$<?= $total?></b>

</body>
</html>