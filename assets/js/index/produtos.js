function carregado() {



  
    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })
    


    

    let proximo = document.querySelector("#proximo");
    let anterior = document.querySelector("#anterior");
    let pag1 = document.querySelector("#pag1");
    let pag2 = document.querySelector("#pag2");
    let pag3 = document.querySelector("#pag3");
    let first = document.querySelector("#first");

    let dist1 = "0";
    let dist2 = "-95%";
    let dist3 = "-194%";

    let num_pag = 1;

    pag1.addEventListener("click", function(){
        pag1.classList.add("ativo");
        pag2.classList.remove("ativo");
        pag3.classList.remove("ativo");

        first.style.marginLeft = dist1;

        num_pag = 1;
    })

    pag2.addEventListener("click", function(){
        pag1.classList.remove("ativo");
        pag2.classList.add("ativo");
        pag3.classList.remove("ativo");

        first.style.marginLeft = dist2;

        num_pag = 2;
    })

    pag3.addEventListener("click", function(){
        pag1.classList.remove("ativo");
        pag2.classList.remove("ativo");
        pag3.classList.add("ativo");

        first.style.marginLeft = dist3;

        num_pag = 3;
    })

    proximo.addEventListener("click", function(){
        num_pag++;
        
        if (num_pag == 1) {
            pag1.classList.add("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.remove("ativo");

            first.style.marginLeft = dist1;
        }

        else if (num_pag == 2) {
            pag1.classList.remove("ativo");
            pag2.classList.add("ativo");
            pag3.classList.remove("ativo");

            first.style.marginLeft = dist2;
        }

        else if (num_pag == 3) {
            pag1.classList.remove("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.add("ativo");

            first.style.marginLeft = dist3;
        }

        else if (num_pag > 3){

            pag1.classList.add("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.remove("ativo");

            first.style.marginLeft = dist1;
            
            num_pag = 1;
        }
    })

    anterior.addEventListener("click", function(){
        num_pag--;
        
        if (num_pag == 1) {
            pag1.classList.add("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.remove("ativo");

            first.style.marginLeft = dist1;
        }

        else if (num_pag == 2) {
            pag1.classList.remove("ativo");
            pag2.classList.add("ativo");
            pag3.classList.remove("ativo");

            first.style.marginLeft = dist2;
        }

        else if (num_pag == 3) {
            pag1.classList.remove("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.add("ativo");

            first.style.marginLeft = dist3;
        }

        else if (num_pag < 1){
            pag1.classList.remove("ativo");
            pag2.classList.remove("ativo");
            pag3.classList.add("ativo");

            first.style.marginLeft = dist3;

            num_pag = 3;
        }
    })














    let proximo_2 = document.querySelector("#proximo-2");
    let anterior_2 = document.querySelector("#anterior-2");
    let pag1_2 = document.querySelector("#pag1-2");
    let pag2_2 = document.querySelector("#pag2-2");
    let pag3_2 = document.querySelector("#pag3-2");
    let first_2 = document.querySelector("#first-2");
    let num_pag_2 = 1;

    pag1_2.addEventListener("click", function(){
        pag1_2.classList.add("ativo");
        pag2_2.classList.remove("ativo");
        pag3_2.classList.remove("ativo");

        first_2.style.marginLeft = dist1;

        num_pag_2 = 1;
    })

    pag2_2.addEventListener("click", function(){
        pag1_2.classList.remove("ativo");
        pag2_2.classList.add("ativo");
        pag3_2.classList.remove("ativo");

        first_2.style.marginLeft = dist2;

        num_pag_2 = 2;
    })

    pag3_2.addEventListener("click", function(){
        pag1_2.classList.remove("ativo");
        pag2_2.classList.remove("ativo");
        pag3_2.classList.add("ativo");

        first_2.style.marginLeft = dist3;

        num_pag_2 = 3;
    })

    proximo_2.addEventListener("click", function(){
        num_pag_2++;
        
        if (num_pag_2 == 1) {
            pag1_2.classList.add("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.remove("ativo");

            first_2.style.marginLeft = dist1;
        }

        else if (num_pag_2 == 2) {
            pag1_2.classList.remove("ativo");
            pag2_2.classList.add("ativo");
            pag3_2.classList.remove("ativo");

            first_2.style.marginLeft = dist2;
        }

        else if (num_pag_2 == 3) {
            pag1_2.classList.remove("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.add("ativo");

            first_2.style.marginLeft = dist3;
        }

        else if (num_pag_2 > 3){
            pag1_2.classList.add("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.remove("ativo");

            first_2.style.marginLeft = dist1;
            num_pag_2 = 1;
        }
    })

    anterior_2.addEventListener("click", function(){
        num_pag_2--;
        
        if (num_pag_2 == 1) {
            pag1_2.classList.add("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.remove("ativo");

            first_2.style.marginLeft = dist1;
        }

        else if (num_pag_2 == 2) {
            pag1_2.classList.remove("ativo");
            pag2_2.classList.add("ativo");
            pag3_2.classList.remove("ativo");

            first_2.style.marginLeft = dist2;
        }

        else if (num_pag_2 == 3) {
            pag1_2.classList.remove("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.add("ativo");

            first_2.style.marginLeft = dist3;
        }

        else if (num_pag_2 < 1){

            pag1_2.classList.remove("ativo");
            pag2_2.classList.remove("ativo");
            pag3_2.classList.add("ativo");

            first_2.style.marginLeft = dist3;

            num_pag_2 = 3;
        }
    })


















    let proximo_3 = document.querySelector("#proximo-3");
    let anterior_3 = document.querySelector("#anterior-3");
    let pag1_3 = document.querySelector("#pag1-3");
    let pag2_3 = document.querySelector("#pag2-3");
    let pag3_3 = document.querySelector("#pag3-3");
    let first_3 = document.querySelector("#first-3");
    let num_pag_3 = 1;

    pag1_3.addEventListener("click", function(){
        pag1_3.classList.add("ativo");
        pag2_3.classList.remove("ativo");
        pag3_3.classList.remove("ativo");

        first_3.style.marginLeft = dist1;

        num_pag_3 = 1;
    })

    pag2_3.addEventListener("click", function(){
        pag1_3.classList.remove("ativo");
        pag2_3.classList.add("ativo");
        pag3_3.classList.remove("ativo");

        first_3.style.marginLeft = dist2;

        num_pag_3 = 2;
    })

    pag3_3.addEventListener("click", function(){
        pag1_3.classList.remove("ativo");
        pag2_3.classList.remove("ativo");
        pag3_3.classList.add("ativo");

        first_3.style.marginLeft = dist3;

        num_pag_3 = 3;
    })

    proximo_3.addEventListener("click", function(){
        num_pag_3++;
        
        if (num_pag_3 == 1) {
            pag1_3.classList.add("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.remove("ativo");

            first_3.style.marginLeft = dist1;
        }

        else if (num_pag_3 == 2) {
            pag1_3.classList.remove("ativo");
            pag2_3.classList.add("ativo");
            pag3_3.classList.remove("ativo");

            first_3.style.marginLeft = dist2;
        }

        else if (num_pag_3 == 3) {
            pag1_3.classList.remove("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.add("ativo");

            first_3.style.marginLeft = dist3;
        }

        else if (num_pag_3 > 3){
            pag1_3.classList.add("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.remove("ativo");

            first_3.style.marginLeft = dist1;
            num_pag_3 = 1;
        }
    })

    anterior_3.addEventListener("click", function(){
        num_pag_3--;
        
        if (num_pag_3 == 1) {
            pag1_3.classList.add("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.remove("ativo");

            first_3.style.marginLeft = dist1;
        }

        else if (num_pag_3 == 2) {
            pag1_3.classList.remove("ativo");
            pag2_3.classList.add("ativo");
            pag3_3.classList.remove("ativo");

            first_3.style.marginLeft = dist2;
        }

        else if (num_pag_3 == 3) {
            pag1_3.classList.remove("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.add("ativo");

            first_3.style.marginLeft = dist3;
        }

        else if (num_pag_3 < 1){

            pag1_3.classList.remove("ativo");
            pag2_3.classList.remove("ativo");
            pag3_3.classList.add("ativo");

            first_3.style.marginLeft = dist3;

            num_pag_3 = 3;
        }
    })


}
