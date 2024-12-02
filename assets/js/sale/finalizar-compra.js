function carregado() {

    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })

    let cartao = document.querySelector("#cartao");
    let aparecer = document.querySelector("#aparecer");
    let verificar = document.querySelector("#verificar");
    let botao = document.querySelector("#botao");

    // document.getElementById("cartao").addEventListener("click", function(){
    //     aparecer.style.display = "flex" 
    // })

    // verificar.addEventListener("click", function (){
    //     if (cartao.checked) {
    //         aparecer.style.display = "flex";
    //         botao.style.bottom = "5%";
    //     }
    //     else{
    //         aparecer.style.display = "none";
    //         botao.style.bottom = "none";
    //     }
    // });

   
    if (window.screen.availHeight >= 768) {
        verificar.addEventListener("click", function (){
            if (cartao.checked) {
                aparecer.style.display = "flex";
                botao.style.bottom = "6%";
                aparecer.style.height = "auto";
            }
            else{
                aparecer.style.display = "none";
                botao.style.bottom = "none";
                aparecer.style.height = "0";
            }
        });
    } 
      
    else {
        verificar.addEventListener("click", function (){
            if (cartao.checked) {
                aparecer.style.display = "flex";
                botao.style.transform = "translate(0%, 100%)";
                aparecer.style.height = "auto";
            }
            else{
                aparecer.style.display = "none";
                botao.style.transform = "translate(0%, 0%)";
                aparecer.style.height = "0";
            }
        });
    }
   
    
}
  