<head>
    <link rel="stylesheet" href="../assets/css/productRelatedSelect/relacionados-parte.css">
</head>

    <div class="relacionados"> <!-- nos prudutos relacionados são 14 produtos, o 15 é o botão de ver mais -->
      <p class="titulo"><span>Produtos relacionados</span></p>  <!-- TITULO DO CONTEUDO DA PAGINA -->
      <div class="flex-relacionados">
          <?php foreach($selectProduct as $k => $product):?>     
              <div class="products" <?php  if ($k == 0): ?>id="first" <?php endif; ?> > <!-- PRODUTOS -----  o primeiro produto tem q ter o id first obrigatoriamente, mas só ele-->
                <div class="star"><i class='bx bxs-star'></i><span><?= $product['assess']?></span></div>   <!-- inserir as avaliacoes -->
                <div class="img-products"><img src="../imagem/<?= $product['image'] ?>" ></div>
                  <p> <?= $product['name'] ?></p> <!-- Nome do produto  -->
                  <div class="preco-flex">
                    <p class="preco formatar-preco"><?= $product['price']['min']?></p>
                    <p class="traco">-</p>
                    <p class="preco formatar-preco"><?= $product['price']['max']?></p>
                  </div>
                  <a class="btn-adic" href="produto.php?idProduct=<?= $product['id']?>">Visualizar</a> <!-- ver se vai ter q colocar um a -->
              </div>
          <?php endforeach;?>
          <div class="products"> <!-- PRODUTO -->
              <button class="btn-adic">Ver Mais</button>
          </div>
      </div>





      <div class="anterior" id="anterior"><i class='bx bx-left-arrow-alt'></i></div><!-- seta para voltar -->
      <div class="proximo" id="proximo"><i class='bx bx-right-arrow-alt'></i></div><!-- seta para avançar -->
      <div class="bolinha">
          <div class="ball ativo" id="pag1"></div>
          <div class="ball" id="pag2"></div>
          <div class="ball" id="pag3"></div>
          <!-- <div class="ball" id="pag4"></div>
          <div class="ball" id="pag5"></div>
          <div class="ball" id="pag6"></div> -->
      </div>
  </div>

<script src="../assets/js/productRelatedSelect/productRelated.js"></script>

