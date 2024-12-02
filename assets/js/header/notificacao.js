let notificacao = document.querySelector("#notificacao");
let div_notificacao = document.querySelector("#div-notificacao");
let URL = "colocar a o caminha para as notificações";
let num = 0;
var windowWidth = window.innerWidth;



notificacao.addEventListener("click", function () {
    if (window.screen.availWidth <= 834) {
        {
            // tamanho = 1;
            alert("ola");
            // window.location.href = URL; // comando para mandar para a outra pagina
        }
    }
    else{
        // tamanho = 0;
        if (num == 1){
            div_notificacao.style.right = "-600px"; 
            num = 0;
        }
        else{
            div_notificacao.style.right = "15px"; 
            num = 1;
        }
    }
});