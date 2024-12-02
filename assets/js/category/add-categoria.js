function Carregado(){
// add-categoria.js
document.getElementById('foto-produto').addEventListener('change', function(event) {
    const mostrarImg = document.getElementById('mostrar-img');
    const file = event.target.files[0]; // Obtém o primeiro arquivo (imagem) selecionado pelo usuário
    
    if (file) {
        const reader = new FileReader();
        
        // Define a função para ser executada quando o arquivo for carregado
        reader.onload = function(e) {
            mostrarImg.src = e.target.result; // Define o src da imagem com o resultado da leitura
        };
        
        reader.readAsDataURL(file); // Lê o conteúdo do arquivo como URL de dados
    }
});

}