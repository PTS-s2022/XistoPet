
   
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
            num_pag = 3;
        }
    })
