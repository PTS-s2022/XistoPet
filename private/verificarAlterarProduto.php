<?php
session_start();
require_once("../libs/config.php");

// Conecção bd
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


//verificar se o metodo é igual a post
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}
//verifica se os campos estão preenchidos
if(empty($_POST['produto']) || empty($_POST['nomeProduto']) || empty($_POST['descricaoProduto']) || empty($_POST['preco'])){
  $_SESSION["ERROR"] = "Preencha os campos corretamente!!";
  header("Location: ../public/alterarProduto.php?produto=".$_POST['produto']);
  die();
}

//Verificando se esse produto existe
$veriProduto = $bd->prepare("SELECT * FROM tb_produto WHERE id = :id");
$veriProduto->execute(
    [
    ":id" => $_POST['produto'],
    ]
);
$produto = $veriProduto->fetch();

if($veriProduto->rowCount() == 0)
{
  header("Location: ../private/index.php");
  die();
}

//verifica se os campos foram alterados
if($_POST['nomeProduto'] == $produto['nome'] && $_POST['descricaoProduto'] == $produto['descricao'] && $_POST['preco'] == $produto['preco']){
  $_SESSION["ERROR"] = "os valores são os mesmos";
  header("Location: ../public/alterarProduto.php?produto=".$_POST['produto']);
  die();
}

$updateProduto = $bd->prepare("UPDATE tb_produto SET nome = :nome, descricao = :descricao, preco = :preco, categoria = :categoria 
                               WHERE id = :produto");
$updateProduto->execute(
  [
    ":nome" => $_POST['nomeProduto'],
    ":descricao" => $_POST['descricaoProduto'],
    ":preco" => $_POST['preco'],
    ":categoria" => $_POST['categoria'],
    ":produto" => $_POST['produto']
  ]
);

$_SESSION["ERROR"] = "Valores alterados com sucesso";
header("Location: ../public/produto.php?produto=".$_POST['produto']);