var url = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/accounts";
var url02 = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/accounts/status";

var btnListAccount = document.querySelector("#btnListAccount");

var form = document.querySelector("#form-account");
form.onsubmit = function(event){
    event.preventDefault();
 
    var conta = {};

    conta.idAccount = document.querySelector("#txtidAccount");
    conta.accountName = document.querySelector("#txtname").value;
    conta.accountType = document.querySelector("#txttype").value;
    conta.accountStatus = document.querySelector("#txtstatus").value;
    
    console.log(JSON.stringify(conta));

    var idAccount = document.querySelector("#txtidAccount").value;
    
    if(idAccount == "") 
        enviarConta(conta);
    else
        atualizarDadosConta(conta, idAccount);
}

function enviarConta(conta){
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log("Response recebido!");
            limparFormulario();
            carregarContas();
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(conta));
}

function editarConta(idAccount) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var conta = JSON.parse(this.responseText);
            document.querySelector("#txtname").value = conta.accountName;
            document.querySelector("#txttype").value =  conta.accountType;
            document.querySelector("#txtstatus").value = conta.accountStatus;
            document.querySelector("#txtidAccount").value = idAccount;
        }
    };
    xhttp.open("GET", url + "/" + idAccount, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function atualizarDadosConta(conta, idAccount){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
    
       if (this.readyState === 4 && this.status === 200) {            
            console.log("Response recebido!");
            limparFormulario();
            carregarContas();
        }
    };
    xhttp.open("PUT", url + "/" + idAccount, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(conta));
}

function excluirConta(idAccount) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarContas();
        }
    };
    xhttp.open("PUT", url02 + "/" + idAccount, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function limparFormulario(){
    document.querySelector("#txtname").value="";
    document.querySelector("#txttype").value="";
    document.querySelector("#txtstatus").value="";
    document.querySelector("#txtidAccount").value="";     
}

function confirmarExcluir(idAccount) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirConta(idAccount);
    else 
        false;
}

function carregarContas() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            montarTabela(JSON.parse(this.responseText));
        }
    };
    
    xhttp.open("GET", url, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function montarTabela(contas) {

    var concat="";
    concat+= "<button type='button' class='btn btn-primary mt-5' id='btnNewAccount' data-toggle='modal' data-target='#newAccount'>Nova Conta</button>"
    concat+= "<table class='table table-concatiped table-dark table-hover mt-5'>";
    concat+= "<tr>";
    concat+= "<th class='text-warning'>Nome da Conta</th>";
    concat+= "<th class='text-warning'>Tipo de conta</th>";
    concat+= "<th class='text-warning'>Status</th>";
    concat+= "<th class='text-warning' colspan='2'>Ações</th>";
    concat+= "</tr>";

    for(var i in contas){
        concat+="<tr>";
        concat+="<td>" + contas[i].accountName + "</td>";
        concat+="<td>" + contas[i].accountType + "</td>";
        concat+="<td>" + contas[i].accountStatus + "</td>";
        concat+="<td onclick='editarConta(" + contas[i].idAccount + ")'<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#newAccount'>Editar</button></td>";
        concat+="<td onclick='confirmarExcluir(" + contas[i].idAccount + ")'<button type='button' class='btn btn-danger ml-2'>Deletar</button></td>";
        concat+="</tr>";
    } 
    concat+= "</table>";

    var tabela = document.querySelector("#showTableAccounts");
    tabela.innerHTML = concat;
}


document.querySelector("#btnListAccount").addEventListener("click", function(){ carregarContas()}); 