function carregado(){

  let ct = document.querySelectorAll(".foto-produto-add").length;
    let addProdutoFix = document.querySelector("#foto-produto0");
    let imageContainer = document.getElementById("image-container");
    
    // Evento para o primeiro input fixo
    addProdutoFix.addEventListener("change", function (e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];
    
      if (file) {

        const reader = new FileReader();
        reader.addEventListener("load", function (e) {
          const readerTarget = e.target;
    
          // Atualiza o primeiro input fixo
          const label = document.querySelectorAll(".foto");
          const NumFoto = document.querySelectorAll(".numFoto");
          const img = document.querySelectorAll(".img-prod");
          const bxCamera = document.querySelectorAll(".bxs-camera-plus");
    
          if (label[0]){
            label[0].style.backgroundColor = "transparent";
            const newILx = document.createElement("i");
            const newDivlx = document.createElement('div');

            newILx.className = 'bx bx-trash';
            newDivlx.className = 'lx';

            newDivlx.appendChild(newILx);  // O ícone lixeira vai dentro do newDivlx
            label[0].appendChild(newDivlx); // Adiciona o newDivlx (com o ícone de lixeira) ao label
            
            newILx.addEventListener("click", function() {
              NumFoto[0].remove();  // Remove o container inteiro (incluindo o label e o input)
            });
            
          } 
          if (img[0]) {
            img[0].src = readerTarget.result;
            img[0].classList.remove("img-prod");
            img[0].classList.add("img-ativo");
          }
          if (bxCamera[0]) bxCamera[0].remove();
    
          // Cria um novo input dinamicamente
          createNewInput();
        });
    
        reader.readAsDataURL(file);
      }
    });
    
    // Função para criar e gerenciar novos inputs
    function createNewInput() {
      const newDiv = document.createElement("div");
      const newLabel = document.createElement("label");
      const newInput = document.createElement("input");
      const newImg = document.createElement("img");
      const newIFt = document.createElement("i");
      const newILx = document.createElement("i");
      const newDivlx = document.createElement('div');
      const fileNameSpan = document.createElement("span");
    
      // Configurações únicas para o novo input
      const forImg = `foto-produto${ct}`;
      newInput.type = "file";
      newInput.name = forImg;
      newInput.id = forImg;
      newInput.className = "foto-produto-add";
    
      newLabel.setAttribute("for", forImg);
      newLabel.className = "foto";
    
      newImg.className = "img-prod";
      newIFt.className = "bx bxs-camera-plus";
      newILx.className = 'bx bx-trash';
      newDivlx.className = 'lx desativo-lx';
    
      fileNameSpan.className = "file-name";
    
      // Adiciona o ícone de lixeira (newILx) no newDivlx
      newDivlx.appendChild(newILx);  
      newLabel.appendChild(newIFt);  // Adiciona o ícone da câmera
      newLabel.appendChild(newImg);  // Adiciona a imagem (em branco inicialmente)
      newLabel.appendChild(newDivlx); 
      newDiv.appendChild(newInput);  // Adiciona o input file
      newDiv.appendChild(newLabel);  // Adiciona o label
      newDiv.appendChild(fileNameSpan);  // Adiciona o span para nome de arquivo
      imageContainer.appendChild(newDiv);  // Adiciona o container ao imageContainer
    
      // Evento para o novo input criado dinamicamente
      newInput.addEventListener("change", function (e) {
        handleFileInput(e.target, newIFt, newImg, newLabel, fileNameSpan);
        newDivlx.classList.remove("desativo-lx")
      });
    
      // Evento para remover o label ao clicar no ícone de lixeira
      newILx.addEventListener("click", function() {
        newDiv.remove();  // Remove o container inteiro (incluindo o label e o input)
      });
    
      ct++; // Incrementa o contador
    }
    
    // Função para manipular o carregamento de arquivos
    function handleFileInput(inputElement, iconElement, imgElement, labelElement, fileNameSpan) {
      const file = inputElement.files[0];
      if (file) {
        const reader = new FileReader();
    
        reader.addEventListener("load", function (e) {
          const readerTarget = e.target;
          if (labelElement) {
            labelElement.style.backgroundColor = "transparent";

          }
          if (imgElement) {
            imgElement.src = readerTarget.result;
            imgElement.classList.remove("img-prod");
            imgElement.classList.add("img-ativo");
          }
          if (iconElement && iconElement.parentNode) {
            iconElement.remove();
          }
        });
    
        reader.readAsDataURL(file);
    
        // Exibe o nome do arquivo no span
        // fileNameSpan.textContent = file.name;  
    
        // Após manipular o arquivo, cria um novo input para o próximo carregamento
        createNewInput();
      }
    }

    let edtImage = document.querySelectorAll(".edt-image");
    let IdnumFoto = document.querySelectorAll(".IdnumFoto");

    edtImage.forEach(function(e, index){
      e.addEventListener("click", function(){
        IdnumFoto[index].remove();
      })
    })

    let letract = document.querySelector("#review-text");
    let contar = document.querySelector("#ct");

    letract.addEventListener("input", function(){
        qtdletra = letract.value.length;
        contar.innerText = qtdletra;
    })



    let SelectColor = document.querySelectorAll(".Select-color");
    let LabelColor = document.querySelectorAll(".Label-color");

     SelectColor.forEach(function(inputColor,num) {
        inputColor.addEventListener("input", function(){
            LabelColor[num].style.backgroundColor = inputColor.value;
        });
        
    });

    let addPT = document.querySelector("#add-p-t");
    let tamanhoP = document.querySelector("#tamanho-p");
    let IdSize = document.querySelector("#idSize");
    let divCor = document.querySelector("#div-cor");
    let precoP = document.querySelector("#preco-p");
    let addCor = document.querySelector("#add-cor");
    // let inputTamanho = document.querySelector(".input-tamanho");
    // let inputPreco = document.querySelector(".input-preco");
    let cont = document.querySelectorAll(".input-tamanho").length - 1;
    let contCor = 1;

    

    addPT.addEventListener("click", function(){

        let novoInputSize = document.createElement("input");
        let novoInputprice = document.createElement("input");
        let novoInputid = document.createElement("input");

        novoInputSize.type = "text";
        novoInputSize.className = "sizes input-tamanho";
        novoInputprice.type = "text";
        novoInputprice.className = "sizes input-preco";
        novoInputid.type = "hidden";
        novoInputid.value = "0";

        cont++;
        novoInputSize.name = `tamanho${cont}`;

        tamanhoP.appendChild(novoInputSize);

        novoInputprice.name = `preco${cont}`;

        precoP.appendChild(novoInputprice);

        novoInputid.name = `idSize${cont}`;

        IdSize.appendChild(novoInputid);
    })


    addCor.addEventListener("click", function(){

        let novoInputcor = document.createElement("input");
        let novoLabelcor = document.createElement("label");
    
        novoInputcor.type = "color";
        novoInputcor.className = "Select-color";
        novoLabelcor.className = "Label-color";
        
        contCor++;
        let forlabel = `cor${contCor}`;
        novoLabelcor.setAttribute("for", forlabel);
        novoInputcor.name = `cor${contCor}`;
        novoInputcor.id = `cor${contCor}`;

        novoInputcor.addEventListener("input", function() {
            novoLabelcor.style.backgroundColor = novoInputcor.value;
        });

        divCor.appendChild(novoInputcor);
        divCor.appendChild(novoLabelcor);

       
    })

}
