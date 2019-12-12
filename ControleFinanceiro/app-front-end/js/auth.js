var tokenEndPoint = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/auth";

document.querySelector("#buscarTokenBtn").addEventListener("click", e => buscarToken(e));

function buscarToken(e) {
    e.preventDefault();
    // busca os valores digitados nos campos de usuário e senha
    var login = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // verifica se os campos tem conteúdo 
    if(login != "" && password != "") {
        
        // cria uma estrutura JSON para os dados obtidos do front-end
        dados = {
            login: login,
            password: password
        };

        const req = $.ajax({
           method: "POST",
           contentType: "application/json",
           url: tokenEndPoint,
           data: JSON.stringify(dados) 
        })

        req.done(res => {
            console.log('done',res)
            //res.JSON.parse(this.responseText);
            sessionStorage.setItem('token',res.token);
            window.location.href = "main.html";
        }) /* sucesso */
        
        req.fail(res => {
            document.querySelector("#mensagem").innerHTML = "Login ou senha inválidos!"; 
        }) /* erro */
    
    } else {
        document.querySelector("#mensagem").innerHTML = "Por favor, preencha todos os campos";        
    }
}



