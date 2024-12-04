<footer class="footer">
  <div class="footer-container">
      <div class="footer-linha">
          <!-- <div class="footer-coll">
              <a href="#" class="logo-footer"></a>
          </div> -->
          <div class="footer-coll">
              <a href="#" class="logo-footer"></a>
              <div class="footer-redes">
                  <a href="" class="footer-social-midia"><i class='bx bxl-instagram'></i></a>
                  <a href="" class="footer-social-midia"><i class='bx bxl-facebook-circle'></i></a>
                  <a href="" class="footer-social-midia"><i class='bx bxl-gmail'></i></a>
              </div>
              
          </div>
      
          <div class="footer-flex-direitos">
              <div class="footer-coll">
                  <span class="footer-titulo">Políticas</span>
                  <a href="termosCondicoes.php" class="footer-texto">Termos e condições</a>
                  <a href="politicaPrivacidade.php" class="footer-texto">Política de privacidade</a>
              </div>
              <div class="footer-coll">
                  <span class="footer-titulo">Sobre nós</span>
                  <a href="sobreNos.php" class="footer-texto">Sobre a XistoPet</a>
                  <!-- <a href="" class="footer-texto">Nossa história</a> -->
              </div>
          </div>
          <div class="footer-coll">
              <span class="footer-titulo-mapa-site">Mapa do site</span>
              <div class="link-flex">
                <a href="perfil.php" class="footer-texto">Perfil</a>
                <?php if(isset($_SESSION['user']['admin'])):?>
                    <a href="vendaGerenciar.php" class="footer-texto">Gerenciar pedidos</a>
                    <a href="produtoGerenciar.php" class="footer-texto">Gerenciar produtos</a>
                    <a href="fornecedorGerenciar.php" class="footer-texto">Gerenciar fornecedor</a>
                    <a href="adminGerenciar.php" class="footer-texto">Gerenciar administrador</a>
                <?php else:?>
                    <a href="carrinho.php" class="footer-texto">Carrinho</a>
                    <a href="pedidos.php" class="footer-texto">Pedidos</a>
                    <a href="notificacao.php" class="footer-texto">Notificações</a>
                    <a href="addCartao.php" class="footer-texto">Cartão</a>
                    <a href="addEndereco.php" class="footer-texto">Endereço</a>
                <?php endif;?>
                <a href="senhaAlterar.php" class="footer-texto">Alterar senha</a>

              </div>
          </div>
      
      </div>
      <div class="footer-linha">
          <div class="footer-metodos">
              <div class="footer-contato">
                  <div class="footer-subtitulo">
                      Contato
                  </div>
                  <div class="footer-telefone">
                      <span class="footer-titulo-telefone">Telefone: </span> <span class="footer-numero-telefone">(15) 99757-7535</span>
                  </div>
                  <div class="footer-email">
                      <span class="footer-titulo-telefone">Email: </span> <span class="footer-numero-telefone">xistopet@gmail.com</span>
                  </div>
              </div>
              <div class="footer-metodo-pagamento">
                  <div class="footer-subtitulo">
                      Formas de pagamento
                  </div>

                  <div class="footer-div-bandeiras">
                      <img src="..\assets\css\header\imagens\bandeiras2.png" alt="" class="footer-img-bandeiras">
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="footer-direitos">
      © Todos os direitos reservados
  </div>
</footer>