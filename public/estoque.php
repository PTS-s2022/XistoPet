<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar estoque</title> 
    <link rel="stylesheet" href="../assets/css/stock/estoque.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="Carregado()">
  
<?php
    require_once('../libs/header.php');
  ?>     

  <div class="container-alto">
      <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
        <p class="titulo1"><span>Gerenciar estoque</span></p>
          
        <form action="" class="card"> <!-- GERENCIAR administrador -->
            <div class="div-select">
                <select name="Fornecedor" id="" class="select" required>
                    <option value="" disabled selected>Selecione um Fornecedor</option>
                    <option value="1">PetLove</option>
                </select>
            </div>
            <div class="content">
                <div class="image"><img src="../imagem/1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_1.jpg" alt=""></div>
                <div class="list">
                    <div class="input">
                        <span class="tamanho">10Kg</span><input type="number" name="" id="" class="input-estoque" placeholder="Preencha o estoque">
                    </div>
                    <div class="input">
                        <span class="tamanho">10Kg</span><input type="number" name="" id="" class="input-estoque" placeholder="Preencha o estoque">
                    </div>
                    <div class="input">
                        <span class="tamanho">10Kg</span><input type="number" name="" id="" class="input-estoque" placeholder="Preencha o estoque">
                    </div>
                    <div class="input">
                        <span class="tamanho">10Kg</span><input type="number" name="" id="" class="input-estoque" placeholder="Preencha o estoque">
                    </div>
                </div>
            </div>
            <div class="div-button">
                <button class="btn">Salvar</button>
            </div>
        </form>
      </div> <!-- FIM DO CONTEUDO DA PÁGINA -->
  </div>

  <?php
  require_once('../libs/footer.html');
  ?>
<body>
  <script src="gestao_administrador.js"></script>
</html>