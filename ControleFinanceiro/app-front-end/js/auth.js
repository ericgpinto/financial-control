var tokenEndPoint = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/auth";

document.querySelector("#buscarTokenBtn").addEventListener("click", e => buscarToken(e));

function buscarToken(e) {
    e.preventDefault();
    
    var login = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    
    if(login != "" && password != "") {
        
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

            sessionStorage.setItem('token',res.token);
            window.location.href = "main.html";
        }) 
        
        req.fail(res => {
            document.querySelector("#mensagem").innerHTML = "Login ou senha inválidos!"; 
        }) 
    
    } else {
        document.querySelector("#mensagem").innerHTML = "Por favor, preencha todos os campos";        
    }
}



