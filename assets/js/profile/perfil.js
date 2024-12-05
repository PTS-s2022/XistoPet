function carregado() {

  let formatarPreco = document.querySelectorAll(".formatar-preco");

  formatarPreco.forEach(function(Numpreco, index){
      let valorPreco = Numpreco.innerHTML;
      let precoFormatado = Number(valorPreco)

      Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
  })


  let all = document.querySelector("#all");
let cancelar = document.querySelector("#cancelar");
let blur = document.querySelector("#blur");
let sair = document.querySelector("#sair");
let body = document.querySelector("#body");
let html = document.querySelector("#html");

sair.addEventListener("click", function () {
   all.style.display = "flex"; 
   body.style.overflow = "hidden";
   html.style.overflow = "hidden";
//    document.body.style.overflow = "hidden";
   blur.style.filter = "blur(5px)";
  menu.style.right = dist_fora;

});



cancelar.addEventListener("click", function () {
    all.style.display = "none"; 
    body.style.overflow = "";
    html.style.overflow = "";
    // blur.style.overflow = "";
    blur.style.filter = "";
 });





  // aqui é os botões pra mostrar
  let ir_dados = document.querySelector("#ir-dados-pessoais");
  let ir_cartoes = document.querySelector("#ir-cartoes");
  let ir_favoritos = document.querySelector("#ir-favoritos");
  let ir_enderecos = document.querySelector("#ir-enderecos");

  let dados_pessoais = document.querySelector("#dados-pessoais");
  let cartoes = document.querySelector("#cartoes");
  let favoritos = document.querySelector("#favoritos");
  let enderecos = document.querySelector("#enderecos");



// evento click para mostar as telas
ir_dados.addEventListener("click", function () {
  dados_pessoais.style.display = "inline-block";
  cartoes.style.display = "none";
  favoritos.style.display = "none";
  enderecos.style.display = "none";
});


ir_cartoes.addEventListener("click", function () {
  dados_pessoais.style.display = "none";
  cartoes.style.display = "inline-block";
  favoritos.style.display = "none";
  enderecos.style.display = "none";
});

ir_favoritos.addEventListener("click", function () {
  dados_pessoais.style.display = "none";
  cartoes.style.display = "none";
  favoritos.style.display = "inline-block";
  enderecos.style.display = "none";
});

ir_enderecos.addEventListener("click", function () {
  dados_pessoais.style.display = "none";
  cartoes.style.display = "none";
  favoritos.style.display = "none";
  enderecos.style.display = "inline-block";
});

// botões do header
let ir_dados_header = document.querySelector("#ir-dados-pessoais-header");

// mostrar quando clicar no botao do header
ir_dados_header.addEventListener("click", function () {
  dados_pessoais.style.display = "inline-block";
  cartoes.style.display = "none";
  favoritos.style.display = "none";
  enderecos.style.display = "none";
});


let ir_dados_responsivo = document.querySelector("#ir-dados-pessoais-responsivo");
let ir_cartoes_responsivo = document.querySelector("#ir-cartoes-responsivo");
let ir_favoritos_responsivo = document.querySelector("#ir-favoritos-responsivo");
let ir_enderecos_responsivo = document.querySelector("#ir-enderecos-responsivo");

// evento click para mostar as telas nos botoes responsivo
ir_dados_responsivo.addEventListener("click", function () {
dados_pessoais.style.display = "inline-block";
cartoes.style.display = "none";
favoritos.style.display = "none";
enderecos.style.display = "none";
menu.style.right = dist_fora;
// menu.style.left = ""; 

});


ir_cartoes_responsivo.addEventListener("click", function () {
dados_pessoais.style.display = "none";
cartoes.style.display = "inline-block";
favoritos.style.display = "none";
enderecos.style.display = "none";
menu.style.right = dist_fora;
// menu.style.left = ""; 

});

ir_favoritos_responsivo.addEventListener("click", function () {
dados_pessoais.style.display = "none";
cartoes.style.display = "none";
favoritos.style.display = "inline-block";
enderecos.style.display = "none";
menu.style.right = dist_fora;
// menu.style.left = ""; 

});

ir_enderecos_responsivo.addEventListener("click", function () {
dados_pessoais.style.display = "none";
cartoes.style.display = "none";
favoritos.style.display = "none";
enderecos.style.display = "inline-block";
menu.style.right = dist_fora;
// menu.style.left = ""; 

});




  // botao burguer da julia
  let burguer = document.querySelector("#burguer");
  let menu = document.querySelector("#menu");
  let dist_fora = "-1000px";
  let dist_dentro = "0";
  let num = 0;

  burguer.addEventListener("click", function () {
    if (num == 1){
      menu.style.right = dist_fora; 
      // menu.style.left = ""; 
      num = 0;
    }
    else{
        menu.style.right = dist_dentro; 
        // menu.style.left = dist_dentro; 
        num = 1;
    }
  });  

// botoes responsivo













}      
