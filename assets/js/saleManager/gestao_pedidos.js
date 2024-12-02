function Carregado(){

    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })
    
    
    let listPedido = document.querySelectorAll(".list-pedido");
    let cardPedido = document.querySelectorAll(".venda");
    let vazio = document.querySelector("#empty");

    listPedido.forEach(function (PedidoNum, inedex){
        PedidoNum.addEventListener("click", function(){
            cardPedido.forEach(function(cardNum){
                cardNum.style.display = "none";
            })

            cardPedido[inedex].style.display = "flex";
            vazio.style.display = "none";

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