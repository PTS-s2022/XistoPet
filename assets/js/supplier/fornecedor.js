function Carregado(){
   
    let listadministrador = document.querySelectorAll(".list-administrador");
    let cardadministrador = document.querySelectorAll(".card3");
    let empty = document.querySelector("#empty");

    listadministrador.forEach(function (administradorNum, inedex){
        administradorNum.addEventListener("click", function(){
            cardadministrador.forEach(function(cardNum){
                cardNum.style.display = "none";
            })

            cardadministrador[inedex].style.display = "flex";
            empty.style.display = "none";
        })
    })

    let burger = document.querySelector("#burguer");
    let list = document.querySelector("#list");
    let flag = false;

    burger.addEventListener("click", function(){
        if(flag){
            list.style.display = "none";
            flag = false;
        }
        else if(flag == false){
            list.style.display = "flex";
            flag = true;
        }
    })




}