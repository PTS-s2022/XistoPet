<?php

use app\libs\product\DisplayProduct;


require_once("../vendor/autoload.php");


$product = new DisplayProduct;


session_start();


$value = [
  'category' => 1
];

$data['animalFood'] = $product->selectProducts($value);

$value = [
  'category' => 2
];

$data['hygieneProduct'] = $product->selectProducts($value);


$value = [
  'category' => 3
];

$data['toy'] = $product->selectProducts($value);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xisto| home</title>
  <meta name="title" content="Kitter - Hight Quality Pet Food">
  <meta name="description" content="This is an eCommerce html template made by codewithsadee">

  <!--- favicon-->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="shortcut icon" href="../assets/css/index/imgs/favicon.svg" type="image/svg+xml">

  <!-- - custom css link -->



  <link rel="stylesheet" href="../assets/css/index/index.css">
  <link rel="stylesheet" href="../assets/css/index/produtos-index.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


  <!--  - google font lin -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">

  <!--  preload imagens-->
  <link rel="preload" as="image" href="imagens/testes_222.png">

</head>

<body id="top" onload="carregado()">

  <?php
  require_once('../libs/header.php');
  ?>

  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image" id="home" aria-label="home"> <!--porte da escrita do header-->
        <div class="container">

          <h1 class="h1 hero-title">
            <span class="span">o melhor para seu </span> Pet
          </h1>

          <p class="hero-text">Venda com até 40% de desconto hoje</p>

          <a href="#" class="btn">Comprar</a> <!-- link -->

        </div>
      </section>

      <!-- 
        - #SLIDER
      -->


      <section class="slider"> <!--slides-->
        <div class="wrapper">
          <div class="slide-wrapper" data-slide="wrapper">
            <button class="slide-nav-button slide-nav-previous fas fa-chevron-left" data-slide="nav-previous-button"></button>
            <button class="slide-nav-button slide-nav-next fas fa-chevron-right" data-slide="nav-next-button"></button>
            <div class="slide-list" data-slide="list">
              <div class="slide-item" data-slide="item" data-index="0">
                <div class="slide-content">
                  <img class="slide-image " src="../assets/css/index/imgs/1.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3> <!--titulo de desgrição-->
                    <p></p> <!--titulo de desgrição-->
                  </div>
                </div>
              </div>
              <div class="slide-item" data-slide="item" data-index="1">
                <div class="slide-content">
                  <img class="slide-image" src="../assets/css/index/imgs/2.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="slide-item" data-slide="item" data-index="2">
                <div class="slide-content">
                  <img class="slide-image" src="../assets/css/index/imgs/3.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="slide-item" data-slide="item" data-index="3">
                <div class="slide-content">
                  <img class="slide-image" src="../assets/css/index/imgs/4.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="slide-item" data-slide="item" data-index="4">
                <div class="slide-content">
                  <img class="slide-image" src="../assets/css/index/imgs/slid-5.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="slide-item" data-slide="item" data-index="5">
                <div class="slide-content">
                  <img class="slide-image" src="../assets/css/index/imgs/slide-7.png" alt="promoção" />
                  <div class="slide-description">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-controls" data-slide="controls-wrapper">
            </div>
          </div>
        </div>

      </section>










      <!--- #CATEGORY--->
      <section class="section category" aria-label="category"> <!--section categoria -->
        <div class="container">

          <h2 class="h2 section-title">
            <span class="span">Top</span> Categorias <!--titulo-->
          </h2>

          <ul class="has-scrollbar">

            <li class="scrollbar-item">
              <div class="category-card">

                <figure class="card-banner img-holder card-size">
                  <img src="../assets/css/index/imgs/category-1.jpg" alt="Cat Food" class="img-cover"> <!-- imagem -->
                </figure>

                <h3 class="h3">
                  <a href="pesquisar.php?category=1" class="card-title">Comida de Gato</a> <!--titulo com link-->
                </h3>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="category-card">

                <figure class="card-banner img-holder card-size">
                  <img src="../assets/css/index/imgs/category-2.jpg" alt="Cat Toys" class="img-cover"> <!-- imagem-->
                </figure>

                <h3 class="h3">
                  <a href="pesquisar.php?category=4" class="card-title">Brinquedos de Gatos </a> <!--titulo com link-->
                </h3>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="category-card">

                <figure class="card-banner img-holder card-size">
                  <img src="../assets/css/index/imgs/category-3.jpg" alt="Dog Food" class="img-cover"> <!--imagem k-->
                </figure>

                <h3 class="h3">
                  <a href="pesquisar.php?category=2" class="card-title">Comida de cachorro</a> <!--titulo com lin-->
                </h3>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="category-card">

                <figure class="card-banner img-holder card-size">
                  <img src="../assets/css/index/imgs/category-4.jpg" alt="Dog Toys" class="img-cover"> <!--imamgem-->
                </figure>

                <h3 class="h3">
                  <a href="pesquisar.php?category=3" class="card-title">Brinquedos de Cachorros</a> <!--titulo com link-->
                </h3>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="category-card">

                <figure class="card-banner img-holder card-size">
                  <img src="../assets/css/index/imgs/category-5.jpg" alt="Dog Sumpplements" class="img-cover"> <!--imagem -->
                </figure>

                <h3 class="h3">
                  <a href="pesquisar.php?category=6" class="card-title">Medicamentos</a> <!--titulo com link-->
                </h3>

              </div>
            </li>

          </ul>

        </div>
      </section>








      <!---- # MAIS VENDDIDO 1-->

      <section class="section mais-vendidos">


        <div class="relacionados"> <!-- nos prudutos relacionados são 14 produtos, o 15 é o botão de ver mais -->

          <h2 class="h2 section-title">
            <span class="span">Top</span> Rações
          </h2>

          <div class="flex-relacionados">
            <?php foreach ($data['animalFood'] as $k => $product): ?>
              <div class="products" <?php if ($k == 1): ?>id="first-1" <?php endif; ?> > <!-- PRODUTOS -----  o primeiro produto tem q ter o id first obrigatoriamente, mas só ele-->
              <div class="img-products"><img src="../imagem/<?= $product['image'] ?>"></div>
              <p> <?= $product['name'] ?></p> <!-- Nome do produto  -->
              <div class="preco-flex">
                <p class="preco formatar-preco"><?= $product['price']['min'] ?></p>
                <p class="traco">-</p>
                <p class="preco formatar-preco"><?= $product['price']['max'] ?></p>
              </div>
              <a class="btn-adic" href="produto.php?idProduct=<?= $product['id'] ?>"> Visualizar</a> <!-- ver se vai ter q colocar um a -->
              </div>
            <?php endforeach; ?>

            <div class="products"> <!-- PRODUTO -->
              <a class="btn-adic" href="pesquisar.php?category=<?= 1?>">Ver Mais</a>
            </div>
          </div>
          <div class="anterior" id="anterior-1"><i class='bx bx-left-arrow-alt'></i></div><!-- seta para voltar -->
          <div class="proximo" id="proximo-1"><i class='bx bx-right-arrow-alt'></i></div><!-- seta para avançar -->
          <div class="bolinha">
            <div class="ball ativo" id="pag1-1"></div>
            <div class="ball" id="pag2-1"></div>
            <div class="ball" id="pag3-1"></div>

          </div>
        </div>
      </section>




      <!--- #CTA--->
      <section class="cta has-bg-image" aria-label="ct">
        <div class="container">

          <figure class="cta-banner">
            <img src="./../assets/css/index/imgs/cta-banner.png" width="900" height="660" loading="lazy" alt="cat" class="w-100"> <!--imagem ( o gato e o fundo dele esta no css )-->
          </figure>

          <div class="cta-content">



            <h2 class="h2 section-title title-responsivo">Aqui temos, o melhor pera seu Pet</h2>

            <p class="section-text">
              Acreditamos que o seu cão e gato vão adorar tanto a nossa comida que, se não o fizerem… iremos ajudá-lo a encontrar uma substituta. Essa é a nossa garantia de sabor.
            </p>

            <a href="#" class="btn">Saber mais</a> <!--link qualquer -->

          </div>

        </div>
      </section>









      <!---- # MAIS VENDDIDO-->

      <section class="section mais-vendidos">


        <div class="relacionados"> <!-- nos prudutos relacionados são 14 produtos, o 15 é o botão de ver mais -->

          <h2 class="h2 section-title">
            <span class="span">Top</span> Brinquedos
          </h2>
          <div class="flex-relacionados">
            <?php foreach ($data['toy'] as $k => $product): ?>
              <div class="products" <?php if ($k == 0): ?>id="first-2" <?php endif; ?> > <!-- PRODUTOS -----  o primeiro produto tem q ter o id first obrigatoriamente, mas só ele-->
              <div class="img-products"><img src="../imagem/<?= $product['image'] ?>"></div>
              <p> <?= $product['name'] ?></p> <!-- Nome do produto  -->
              <div class="preco-flex">
                <p class="preco formatar-preco"><?= $product['price']['min'] ?></p>
                <p class="traco">-</p>
                <p class="preco formatar-preco"><?= $product['price']['max'] ?></p>
              </div>
              <a class="btn-adic" href="produto.php?idProduct=<?= $product['id'] ?>"> Visualizar</a> <!-- ver se vai ter q colocar um a -->
              </div>
            <?php endforeach; ?>
            <div class="products"> <!-- PRODUTO -->
              <a class="btn-adic" href="pesquisar.php?category=<?= 2?>">Ver Mais</a>
            </div>
          </div>
          <div class="anterior" id="anterior-2"><i class='bx bx-left-arrow-alt'></i></div><!-- seta para voltar -->
          <div class="proximo" id="proximo-2"><i class='bx bx-right-arrow-alt'></i></div><!-- seta para avançar -->
          <div class="bolinha">
            <div class="ball ativo" id="pag1-2"></div>
            <div class="ball" id="pag2-2"></div>
            <div class="ball" id="pag3-2"></div>

          </div>
        </div>
      </section>


      <section class=" mais-vendidos">


        <div class="relacionados"> <!-- nos prudutos relacionados são 14 produtos, o 15 é o botão de ver mais -->
          <h2 class="h2 section-title">
            <span class="span">Top</span> Produtos de Higiene
          </h2>
          <div class="flex-relacionados">
            <?php foreach ($data['hygieneProduct'] as $k => $product): ?>
              <div class="products" <?php if ($k == 1): ?>id="first-3"<?php endif; ?> > <!-- PRODUTOS -----  o primeiro produto tem q ter o id first obrigatoriamente, mas só ele-->
              <div class="img-products"><img src="../imagem/<?= $product['image'] ?>"></div>
              <p> <?= $product['name'] ?></p> <!-- Nome do produto  -->
              <div class="preco-flex">
                <p class="preco formatar-preco"><?= $product['price']['min'] ?></p>
                <p class="traco">-</p>
                <p class="preco formatar-preco"><?= $product['price']['max'] ?></p>
              </div>
              <a class="btn-adic" href="produto.php?idProduct=<?= $product['id'] ?>"> Visualizar</a> <!-- ver se vai ter q colocar um a -->
              </div>
            <?php endforeach; ?>
            <div class="products"> <!-- PRODUTO -->
              <a class="btn-adic" href="pesquisar.php?category=<?= 3?>">Ver Mais </a>
            </div>
          </div>
          <div class="anterior-3" id="anterior-3"><i class='bx bx-left-arrow-alt'></i></div><!-- seta para voltar -->
          <div class="proximo-3" id="proximo-3"><i class='bx bx-right-arrow-alt'></i></div><!-- seta para avançar -->
          <div class="bolinha">
            <div class="ball ativo" id="pag1-3"></div>
            <div class="ball" id="pag2-3"></div>
            <div class="ball" id="pag3-3"></div>

          </div>
        </div>






      </section>


      <!---
        - #BRAND
      -->







      <section class="section brand" aria-label="brand">
        <div class="container">

          <h2 class="h2 section-title">
            <span class="span">Melhores</span> Marcas
          </h2>

          <ul class="has-scrollbar">

            <li class="scrollbar-item">
              <div class="brand-card img-holder">
                <img src="../assets/css/index/imagens/brand-1.jpg" width="150" height="150" loading="lazy" alt="brand logo" class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder">
                <img src="../assets/css/index/imagens/brand-2.jpg" width="150" height="150" loading="lazy" alt="brand logo" class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder">
                <img src="../assets/css/index/imagens/brand-3.jpg" width="150" height="150" loading="lazy" alt="brand logo" class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/css/index/imagens/brand-4.jpg" width="150" height="150" loading="lazy" alt="brand logo" class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/css/index/imagens/brand-5.jpg" width="150" height="150" loading="lazy" alt="brand logo" class="img-cover">
              </div>
            </li>

          </ul>

        </div>
      </section>

      <!-- 
        - #PRODUCT
      -->






      <!-- 
        - #SERVICE
      -->






    </article>
  </main>





  <!-- 
    - #FOOTER
  -->
  <?php
  require_once('../libs/footer.html');
  ?>

  <!-- 
    - #voltar ao topo
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="../assets/js/index/index.js" defer></script>
  <script src="../assets/js/index/produtos.js"></script>
  <script src="../assets/js/index/slides.js"></script>
  <script>
    initSlider({
      autoPlay: true,
      startAtIndex: 0,
      timeInterval: 2000
    })
  </script>


  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


</body>

</html>