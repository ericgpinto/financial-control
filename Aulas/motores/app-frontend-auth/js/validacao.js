// validar se a sessão está ativa
function validaAcesso() {
    // TO DO: validar se o token realmente existe e é VÁLIDO!
    // Neste exemplo apenas valida se está nulo ou não
    if(sessionStorage.getItem('token') == null) {
        // redirecionar para a página de login
        location.href = "login.html";
    }
}

// destruir a sessão ativa
function encerraAcesso() {
    // TO DO: apagar o token do banco de dados
    // Apagando o token da sessão local do navegador
    sessionStorage.clear();
    location.href = "login.html";
}

// chamar a função para validar o acesso 
document.onload = validaAcesso();

document.querySelector("#logoutBtn").addEventListener("click", function(){ encerraAcesso() });
