let clicar = document.querySelector("#clicar");
let comentario = document.querySelector("#adicionar2");
let all2 = document.querySelector("#all2");
let cancelar = document.querySelector("#cancelar");
let blur2 = document.querySelector("#blur2");
let html = document.querySelector("html");


let inputStars = document.querySelectorAll(".input-stars");
let stars = document.querySelectorAll(".stars");
let stars2 = document.querySelectorAll(".stars2");
var cont = -1;
var flag = false;



inputStars.forEach(function(inputstarct, index){
    if(inputstarct.checked){
        for (let num = 0; num <= index; num++) {
            stars[num].style.color = "#fff200";
            stars2[num].style.color = "#fff200";
            
        }
    }
})


clicar.addEventListener("click", function(){
    all2.style.display = "flex";
    blur2.style.filter = "blur(5px)";
    html.style.overflowY = "hidden";
})

comentario.addEventListener("click", function(){
    all2.style.display = "flex";
    blur2.style.filter = "blur(5px)";
    html.style.overflowY = "hidden";
})

cancelar.addEventListener("click", function(){
    all2.style.display = "none";
    blur2.style.filter = "blur(0)";
    html.style.overflowY = "";

    inputStars.forEach(function(inputstarct, index){
        inputstarct.checked = false;
        stars[index].style.color = "#ccc";
        stars2[index].style.color = "#ccc";
    })

    cont = -1;

})


stars.forEach(function(starNum, index){
    starNum.addEventListener('click', function(){
        for (let num = 0; num <= 4; num++) {
            if(num <= index){
                stars[num].style.color = "#fff200";
                stars2[num].style.color = "#fff200";

            }
            else{
                stars[num].style.color = "#ccc";
                stars2[num].style.color = "#ccc";
            }
            
        }
    })

    starNum.addEventListener("mouseover", function(){
        for (let num = 0; num <= 4; num++) {
            if(num <= index){
                stars[num].style.color = "#fff200";
                stars2[num].style.color = "#fff200";
                
            }
            else{
                stars[num].style.color = "#ccc";
                stars2[num].style.color = "#ccc";
            }
            
        }

    })  

    starNum.addEventListener("mouseout", function(){
        inputStars.forEach(function(inputStarsNum, num){
            if(inputStarsNum.checked == true){
                cont = num;
                flag == true;
                // alert(cont)
                for (let ct  = cont; ct <= 4; ct++) {
                    stars2[ct].style.color = "#ccc";
                    stars[ct].style.color = "#ccc";
                    
                }

                for (let index = 0; index <= num; index++) {
                    stars[index].style.color = "#fff200";
                    stars2[index].style.color = "#fff200";
                    
                }
            }
            if (cont == -1){
                stars.forEach(function(starsct, ct){
                    stars[ct].style.color = "#ccc";
                    stars2[ct].style.color = "#ccc";
                })
            }
        })
        
    })
      




    let letract = document.querySelector("#review-text");
    let contar = document.querySelector("#ct");

    letract.addEventListener("input", function(){
        qtdletra = letract.value.length;
        contar.innerText = qtdletra;
    })
    
       


})

     
   
