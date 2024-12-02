function carregado() {

    // aparecer imagem imagens

    // icones das imagnes (imagens pequenas - pre visualização)
    
    let miniImg = document.querySelectorAll(".img-mini");
    let Img = document.querySelector("#img-produto");
    miniImg[0].style.border = "2px solid #0296C5";



    miniImg.forEach( function(imgClicada) {
        
        imgClicada.addEventListener("click", function(){

            miniImg.forEach( function(miniImg){
                miniImg.style.border = "2px solid rgba(131, 130, 130)";
            })

            Img.src = imgClicada.src;
            imgClicada.style.border = "2px solid #0296C5";

           
        })
    });
    



    let SelectColor = document.querySelectorAll(".input-color");
    let LabelColor = document.querySelectorAll(".label-cor");
    let ct = 0;
    
    SelectColor.forEach(function(inputColor,num) {
        
            LabelColor[num].style.backgroundColor = inputColor.value;

            if(!LabelColor[num].classList.contains('esgotado-cor') & ct == 0){
                inputColor.checked = true;

                ct++;
            }
        
        
    });

    let inputQtd = document.querySelectorAll(".input-qtd");
    let inputPreco = document.querySelectorAll(".input-preco");
    let preco = document.querySelector("#preco");
    let qtd = document.querySelector("#quantidade");
    let selectTamanho = document.querySelectorAll(".select-tamanho");
    let inputTamanho = document.querySelectorAll(".input-tamanho");
    let precovalue = 0;
    let i = 0;
    let qtdAtual = 1;
    let divQuantidade = document.querySelector("#div-quantidade");
    let addCarrinho = document.querySelector("#add-carrinho");
    let produtoEsgotado = document.querySelector("#produto-esgotado");
    let tira = document.querySelector("#tira");
    let coloca = document.querySelector("#coloca");
    let qtdCarrinho = document.querySelector("#qtd-adc");
    let alert = document.querySelector("#alert");
    let alert2 = document.querySelector("#alert2");
    let tempo = document.querySelector("#tempo");





    inputTamanho.forEach(function(inputTamanhoSel, num){
        if(!selectTamanho[num].classList.contains('esgotado-tamanho') & i == 0){
            inputTamanhoSel.checked = true

            precovalue = inputPreco[num].value;

            let precoformated = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precovalue);

            preco.textContent = precoformated;

            let qtdformatado = inputQtd[num].value; 
            
            qtd.textContent = qtdformatado.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            i++;
        }

    })
    

    selectTamanho.forEach(function(selectedTamanho, index){
    
        selectedTamanho.addEventListener("click", function(){

            precovalue = inputPreco[index].value;

            let precoformated = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(precovalue);

            preco.textContent = precoformated;

            let qtdformatado = inputQtd[index].value; 
                
            qtd.textContent = qtdformatado.replace(/\B(?=(\d{3})+(?!\d))/g, ".");


            let qtdLimite = inputQtd[index].value;
            if (qtdAtual > qtdLimite & qtdLimite > 0){
                qtdCarrinho.value = qtdLimite;
                alert2.textContent = "Quantidade selecionada maior que o estoque";
                alert.style.left = "10px";
                tempo.classList.add("tempo");

                setTimeout(function(){
                    alert.style.animation = "forwards .5s diminui"
                },4500);

                setTimeout(function(){
                    alert.style.left = "-900px";
                    alert2.textContent = "";

                },5000);

                setTimeout(function(){
                    alert.style.left = "-900px";
                    tempo.classList.remove("tempo");
                    alert.style.animation = ""
                },5100);
            }

            if (qtdLimite < 1){
                divQuantidade.style.display = "none";
                LabelColor.forEach(function(labelColorNum,num) {
                    labelColorNum.classList.add("esgotado-cor")
                })

                addCarrinho.classList.add("not-addCarrinho");
                addCarrinho.disabled = true;
                produtoEsgotado.style.display = "flex";
                qtd.style.display = "none";
            }
            else{
                divQuantidade.style.display = "flex";
                LabelColor.forEach(function(labelColorNum,num) {
                    labelColorNum.classList.remove("esgotado-cor")
                })

                addCarrinho.classList.remove("not-addCarrinho");
                addCarrinho.disabled = false;
                produtoEsgotado.style.display = "none";
                qtd.style.display = "flex";

            }
        })

    })

    qtdCarrinho.addEventListener("blur", function(){
        qtdAtual = qtdCarrinho.value;


        alert.style.left = "-900px";
        tempo.classList.remove("tempo");
        alert.style.animation = ""


        if(qtdAtual < 2){
            tira.classList.add("desativo");
            qtdCarrinho.value = 1;

            
        }
        else{
            tira.classList.remove("desativo");

        }

        inputTamanho.forEach(function(inputTamanhoSelected, index){
    
            if(inputTamanhoSelected.checked == true){
                let qtdLimite = inputQtd[index].value;
                if (qtdAtual > qtdLimite){
                    qtdCarrinho.value = qtdLimite;
                    alert2.textContent = "Quantidade selecionada maior que o estoque";
                    alert.style.left = "10px";
                    tempo.classList.add("tempo");

                    setTimeout(function(){
                        alert.style.animation = "forwards .5s diminui"
                    },4500);

                    setTimeout(function(){
                        alert.style.left = "-900px";
                        alert2.textContent = "";

                    },5000);

                    setTimeout(function(){
                        alert.style.left = "-900px";
                        tempo.classList.remove("tempo");
                        alert.style.animation = ""
                    },5100);
                }
            }
    
        })

       

    })

    




    if(qtdAtual < 2){
        tira.classList.toggle("desativo")
    }
    

    tira.addEventListener("click", function(){
        qtdAtual = qtdCarrinho.value;
        if(qtdAtual < 2){
            tira.classList.toggle("desativo")
        }else{
            qtdAtual--;
            qtdCarrinho.value = qtdAtual;
        }

    })

    coloca.addEventListener("click", function(){
        qtdAtual = qtdCarrinho.value;
        if(qtdAtual < 2){
            tira.classList.toggle("desativo")
        }
        
        qtdAtual++;
        qtdCarrinho.value = qtdAtual;

        alert.style.left = "-900px";
        tempo.classList.remove("tempo");
        alert.style.animation = ""
        

        inputTamanho.forEach(function(inputTamanhoSelected, index){
    
            if(inputTamanhoSelected.checked == true){
                let qtdLimite = inputQtd[index].value;
                if (qtdAtual > qtdLimite){
                    qtdCarrinho.value = inputQtd[index].value;
                    alert2.textContent = "Quantidade selecionada maior que o estoque";
                    alert.style.left = "10px";
                    tempo.classList.add("tempo");

                    setTimeout(function(){
                        alert.style.animation = "forwards .5s diminui"
                    },4500);

                    setTimeout(function(){
                        alert.style.left = "-900px";
                        alert2.textContent = "";

                    },5000);

                    setTimeout(function(){
                        alert.style.left = "-900px";
                        tempo.classList.remove("tempo");
                        alert.style.animation = ""
                    },5100);
                }
            }
    
        })
    })


    let precoRelacionados = document.querySelectorAll(".preco");




    precoRelacionados.forEach(function(numPreco){
        let formatpreco = numPreco.innerText;
        formatadopreco = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(formatpreco);

        let salvarPreco = numPreco;

        salvarPreco.innerHTML = formatadopreco;
    })


    let all = document.querySelector("#all");
    let confirmar = document.querySelector("#confirmar");
    let blur = document.querySelector("#blur");
    let body = document.querySelector("body");
    let html = document.querySelector("html");




    confirmar.addEventListener("click", function () {
        all.style.display = "none"; 
        body.style.overflowY = "";
        html.style.overflowY = "";
        // blur.style.overflow = "";
        blur.style.filter = "blur(0px)"
     });

    




    
}
