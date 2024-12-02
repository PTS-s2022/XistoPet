let olho = document.querySelectorAll(".img-olho");
let input = document.querySelectorAll(".senha");

olho.forEach(function (olhoNum, index) {
    olhoNum.addEventListener("click", function () { // Especifica o evento "click"
        if (input[index].type === "password") { // Usa o array correto e "===" para comparar
            olhoNum.src = "../assets/css/alterPassword/imagens/olho.png"; // Usa "=" para atribuir
            input[index].type = "text";
        } else {
            olhoNum.src = "../assets/css/alterPassword/imagens/olhoFechado.png"; // Usa "=" para atribuir
            input[index].type = "password";
        }
    });
});