function carregado(){
    let precoRelacionados = document.querySelectorAll(".preco");

    precoRelacionados.forEach(function(numPreco){
        let formatpreco = numPreco.innerText;
        formatadopreco = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(formatpreco);

        let salvarPreco = numPreco;

        salvarPreco.innerHTML = formatadopreco;
    })
}