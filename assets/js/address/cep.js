function carregado() {
  
    // auto completar com o CEP
    var cep = document.querySelector("#CEP");
    var bairro = document.querySelector("#bairro");
    var cidade = document.querySelector("#cidade");
    var estado = document.querySelector("#estado");
    var rua = document.querySelector("#logradouro");
    let alert = document.querySelector("#alert");
    let alert2 = document.querySelector("#alert2");
    let tempo = document.querySelector("#tempo");
    let label = document.querySelector(".label")
  
    cep.addEventListener("blur", buscacep);
  
    function buscacep() {
      alert.style.left = "-900px";
      tempo.classList.remove("tempo");
      alert.style.animation = ""



      var cep_value = document.querySelector("#CEP").value;
      if (cep.value !== "") {
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep_value;
  
        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();
  
        req.onload = function () {
          if (req.status === 200) {
            let endereco_resp = JSON.parse(req.response);
            rua.value = endereco_resp.street;
            bairro.value = endereco_resp.neighborhood;
            cidade.value = endereco_resp.city;
            estado.value = endereco_resp.state;
            cep.style.border = "1px solid #0296C5";
          } else if (req.status === 404) {
            alert2.textContent = "CEP não encontrado";
            alert.style.left = "10px";
            tempo.classList.add("tempo");
            setTimeout(function(){
              alert.style.animation = "forwards .5s diminui"
            },4500);
            setTimeout(function(){
              alert.style.left = "-900px";
            },5000);
          } 
          else if (cep.value === ""){

          }
          else {
            alert.style.left = "10px";
            tempo.classList.add("tempo");
            setTimeout(function(){
                 alert.style.animation = "forwards .5s diminui"
            },4500);
            setTimeout(function(){
              alert.style.left = "-900px";
            },5000);
            alert2.textContent = "Ops, o CEP está incorreto";
          }
        };
      }
      else if(cep.value === ""){
        rua.value = "";
        bairro.value = "";
        cidade.value = "";
        estado.value = "";
      }
    }



    // aqui é a parte de adicionar endereço
    var div_enderecos = document.querySelector("#div-enderecos");
    var add_endereco = document.querySelector("#add-endereco");
    var cancelar = document.querySelector("#cancelar");
  
    add_endereco.addEventListener("click", function () {
      div_enderecos.style.display = "block";
      add_endereco.style.display = "none";
    });

    cancelar.addEventListener("click", function () {
      div_enderecos.style.display = "none";
      add_endereco.style.display = "block";
      cep.value = "";
      rua.value = "";
      bairro.value = "";
      cidade.value = "";
      estado.value = "";
    });
  }
  