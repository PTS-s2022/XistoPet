function carregado() {



  
    let formatarPreco = document.querySelectorAll(".formatar-preco");

    formatarPreco.forEach(function(Numpreco, index){
        let valorPreco = Numpreco.innerHTML;
        let precoFormatado = Number(valorPreco)

        Numpreco.innerHTML = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precoFormatado);
    })
    


    

    let proximo1 = document.querySelector("#proximo-1");
    let anterior1 = document.querySelector("#anterior-1");
    let pag1_1 = document.querySelector("#pag1-1");
    let pag2_1 = document.querySelector("#pag2-1");
    let pag3_1 = document.querySelector("#pag3-1");
    let first_1 = document.querySelector("#first-1");

    let dist1 = "0";
    let dist2 = "-95%";
    let dist3 = "-194%";

    let num_pag_1 = 1;

    pag1_1.addEventListener("click", function(){
        pag1_1.classList.add("ativo");
        pag2_1.classList.remove("ativo");
        pag3_1.classList.remove("ativo");

        first_1.style.marginLeft = dist1;

        num_pag_1 = 1;
    })

    pag2_1.addEventListener("click", function(){
        pag1_1.classList.remove("ativo");
        pag2_1.classList.add("ativo");
        pag3_1.classList.remove("ativo");

        first_1.style.marginLeft = dist2;

        num_pag_1 = 2;
    })

    pag3_1.addEventListener("click", function(){
        pag1_1.classList.remove("ativo");
        pag2_1.classList.remove("ativo");
        pag3_1.classList.add("ativo");

        first_1.style.marginLeft = dist3;

        num_pag_1 = 3;
    })

    proximo1.addEventListener("click", function(){
        num_pag_1++;
        
        if (num_pag_1 == 1) {
            pag1_1.classList.add("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.remove("ativo");

            first_1.style.marginLeft = dist1;
        }

        else if (num_pag_1 == 2) {
            pag1_1.classList.remove("ativo");
            pag2_1.classList.add("ativo");
            pag3_1.classList.remove("ativo");

            first_1.style.marginLeft = dist2;
        }

        else if (num_pag_1 == 3) {
            pag1_1.classList.remove("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.add("ativo");

            first_1.style.marginLeft = dist3;
        }

        else if (num_pag_1 > 3){

            pag1_1.classList.add("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.remove("ativo");

            first_1.style.marginLeft = dist1;
            
            num_pag_1 = 1;
        }
    })

    anterior1.addEventListener("click", function(){
        num_pag_1--;
        
        if (num_pag_1 == 1) {
            pag1_1.classList.add("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.remove("ativo");

            first_1.style.marginLeft = dist1;
        }

        else if (num_pag_1 == 2) {
            pag1_1.classList.remove("ativo");
            pag2_1.classList.add("ativo");
            pag3_1.classList.remove("ativo");

            first_1.style.marginLeft = dist2;
        }

        else if (num_pag_1 == 3) {
            pag1_1.classList.remove("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.add("ativo");

            first_1.style.marginLeft = dist3;
        }

        else if (num_pag_1 < 1){
            pag1_1.classList.remove("ativo");
            pag2_1.classList.remove("ativo");
            pag3_1.classList.add("ativo");

            first_1.style.marginLeft = dist3;

            num_pag_1 = 3;
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
