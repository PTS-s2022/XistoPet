

    
 // botao burguer da julia
 var burguer = document.querySelector("#burguer");
 var menu = document.querySelector("#menu");
 menu.style.display = "none"

 burguer.addEventListener("click", function () {
   if (menu.style.display == "block") {
     menu.style.display = "none";
   } else {
     menu.style.display = "block";
   }
 });
