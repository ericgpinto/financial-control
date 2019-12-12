var tokenEndPoint = "http://localhost/Programacao_Internet_II/bmmotores/app-motores/api/auth";

document.querySelector("#buscarTokenBtn").addEventListener("click", 
        function(){ 
            buscarToken() 
        }
);

function buscarToken() {

    // busca os valores digitados nos campos de usuário e senha
    var login = document.querySelector("#username").value;
    var senha = document.querySelector("#password").value;

    // verifica se os campos tem conteúdo 
    if(login != "" && senha != "") {
        
        // cria uma estrutura JSON para os dados obtidos do front-end
        dados = {
            login:login,
            senha:senha,
        };

        // instanciar a classe de requisições assíncronas (AJAX)
        var xhttp = new XMLHttpRequest();

        // Espera pela troca para estado de pronto
        // Etapa 3: execução da requisição
        xhttp.onreadystatechange = function() {

            // passou pelas etapas anteriores E se retorno é FALSE 
            if (this.readyState === 4 && this.status === 401) {
                document.querySelector("#mensagem").innerHTML = "Erro no usuário e/ou senha!";      
            } else {
                // passou pelas etapas anteriores E se retorno é TRUE 
                if (this.readyState === 4 && this.status === 201) {
                    // receber o retorno dos dados do web service 
                    retorno = JSON.parse(this.responseText);
                    // armazena o token em uma session storage
                    sessionStorage.setItem('token', retorno.token);
                    // redireciona para a página de CRUD
                    window.location.href = "motores.html";
                }
            }
        };

        // Etapa 1: construir a requisição para o WS com post e a URL
        xhttp.open("POST", tokenEndPoint, true);
        // envia um cabeçalho para reforçar o tipo de conteúdo como JSON
        xhttp.setRequestHeader("Content-Type","application/json");
        // Etapa 2: enviar a requisição com os dados em JSON
        xhttp.send(JSON.stringify(dados));
    
    } else {
        document.querySelector("#mensagem").innerHTML = "Por favor, preencha todos os campos";        
    }
}



