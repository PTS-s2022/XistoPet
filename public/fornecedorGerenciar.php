<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar fornecedor</title> 
    <link rel="stylesheet" href="../assets/css/supplier/gerenciar-fornecedor.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="Carregado()">
  
<?php
    require_once('../libs/header.php');
  ?>     

  <div class="container-alto">
      <div class="flex"> <!-- CONTEUDO DA PÁGINA -->
        <p class="titulo1"><span>Gerenciar fornecedor</span></p>
          
        <form action="" class="card"> <!-- GERENCIAR administrador -->
            <div class="list">
                <div class="div-img">
                    <img src="..\assets\css\admin\img\perfil.png" alt="" class="img">
                </div>
                <div class="form">
                    <div class="div-input">
                        <span class="text">Nome:</span><input type="text" name="" id="" class="input" required>
                    </div>
                    <div class="div-input">
                        <span class="text">CNPJ:</span><input type="text" name="" id="" class="input" required>
                    </div>
                    <div class="div-input">
                        <span class="text">Telefone:</span><input type="number" name="" id="" class="input" required>
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
</html>