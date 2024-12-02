function carregado() {
   
   let formatarPreco = document.querySelectorAll(".formatar-preco");

   formatarPreco.forEach(function(Numpreco, index){
       let valorPreco = Numpreco.innerHTML;
       let precoFormatado = Number(valorPreco)

       Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
   })

    // Limpar carrinho
    let all = document.querySelector("#all");
    let cancelar = document.querySelector("#cancelar");
    let blur = document.querySelector("#blur");
    let limpar = document.querySelector("#limpar");
    let body = document.querySelector("#body");
    let html = document.querySelector("#html");

    limpar.addEventListener("click", function () {
       all.style.display = "flex"; 
       body.style.overflow = "hidden";
       html.style.overflow = "hidden";
    //    document.body.style.overflow = "hidden";

       blur.style.filter = "blur(5px)"
    });

    cancelar.addEventListener("click", function () {
        all.style.display = "none"; 
        body.style.overflow = "";
        html.style.overflow = "";
        // blur.style.overflow = "";
        blur.style.filter = ""
     });
    

}
