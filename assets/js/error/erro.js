let erro = document.querySelector("#erro");
let fechar = document.querySelector("#fechar");
let inputErro = document.querySelector("#entrada-erro");

if(inputErro.value == 0){
    erro.close();

} else if(inputErro.value == 1){
    erro.showModal();

}

fechar.addEventListener("click", function(){
    erro.close();
})