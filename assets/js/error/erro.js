let erro = document.querySelector("#erro");
let fechar = document.querySelector("#fechar");
let inputErro = document.querySelector("#entrada-erro");
let html = document.querySelector("html");

if(inputErro.value == 0){
    erro.close();

} else if(inputErro.value == 1){
    erro.showModal();
    body.style.filter = "blur(5px)";
    body.style.overflowY = "hidden";
}

fechar.addEventListener("click", function(){
    erro.close();
    body.style.filter = "";
    body.style.overflowY = "auto";
})