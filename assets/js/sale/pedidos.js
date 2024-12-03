function Carregado(){
    let Data = document.querySelectorAll(".date");
    Data.forEach(function(DataNum, index){
      DataValue = DataNum.innerHTML;
      let data_brasileira = DataValue.split('-').reverse().join('/');
      DataNum.innerHTML = data_brasileira;

    })

    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })
}