function Carregado(){
    
    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })

    let copy = document.querySelector("#copy");
    let text_copy = document.querySelector("#text");
    let cod_boleto = document.querySelector("#cod");

    copy.addEventListener("click", function(){
        copy.disabled = true;
        navigator.clipboard.writeText(cod_boleto.value);
        setTimeout(function(){
            text_copy.style.animation = "forwards .5s diminui";
          },100);

          setTimeout(function(){
            text_copy.style.animation = "forwards .8s aumenta";
            text_copy.innerHTML = "<i class='bx bx-check'></i>Copiado";
          },700);

          setTimeout(function(){
            text_copy.style.animation = "forwards .5s diminui";
          },3500);

          setTimeout(function(){
            text_copy.style.animation = "forwards .8s aumenta";
            text_copy.innerHTML = "Copiar código";

            copy.disabled = false;

          },4000);
    })



    let copyPix = document.querySelector("#copyPix");
    let text_copyPix = document.querySelector("#textPix");
    let codPix = document.querySelector("#cod-Pix");

    copyPix.addEventListener("click", function(){
        copyPix.disabled = true;
        navigator.clipboard.writeText(codPix.value);
        setTimeout(function(){
            text_copyPix.style.animation = "forwards .5s diminui";
          },100);

          setTimeout(function(){
            text_copyPix.style.animation = "forwards .8s aumenta";
            text_copyPix.innerHTML = "<i class='bx bx-check'></i>Copiado";
          },700);

          setTimeout(function(){
            text_copyPix.style.animation = "forwards .5s diminui";
          },3500);

          setTimeout(function(){
            text_copyPix.style.animation = "forwards .8s aumenta";
            text_copyPix.innerHTML = "Copiar código";

            copyPix.disabled = false;

          },4000);
    })
}