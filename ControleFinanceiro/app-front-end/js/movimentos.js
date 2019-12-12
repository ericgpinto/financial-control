var url = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/movements";
var urlContas = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/accounts";


var body = document.querySelector("body");
var btnListMov = document.querySelector("#btnListMovement");
var comboContas = document.getElementById("cmbAccounts");

body.onload = function(){
    carregarContas();
}

var form = document.querySelector("#form-mov");
form.onsubmit = function(event){
    event.preventDefault();
 
    var movimento = {};
    movimento.idAccount = comboContas.selectedIndex + 1;
    movimento.movementDate = document.querySelector("#date").value;
    movimento.price = document.querySelector("#txtprice").value;
    
    console.log(JSON.stringify(movimento));

    var idMovement = document.querySelector("#txtidMovement").value;
    
    if(idMovement == "") 
        enviarMovimento(movimento);
    else
        atualizarDadosMovimento(movimento, idMovement);
}

function enviarMovimento(movimento){
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log("Response recebido!");
            limparFormulario();
            carregarMovimentos();
            //carregarContas();
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(movimento));
}

function editarMovimento(idMovement) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var movimento = JSON.parse(this.responseText);
            document.querySelector("#cmbAccounts").selectedIndex =  movimento.idAccount - 1;
            document.querySelector("#date").value =  movimento.movementDate;
            document.querySelector("#txtprice").value = movimento.price;
            document.querySelector("#txtidMovement").value = idMovement;
        }
    };
    xhttp.open("GET", url + "/" + idMovement, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function atualizarDadosMovimento(movimento, idMovement){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
    
       if (this.readyState === 4 && this.status === 200) {            
            console.log("Response recebido!");
            limparFormulario();
            carregarMovimentos();
            carregarContas();
        }
    };
    xhttp.open("PUT", url + "/" + idMovement, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(movimento));
}

function excluirMovimento(idMovement) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarMovimentos();
            //carregarContas();
        }
    };
    xhttp.open("DELETE", url + "/" + idMovement, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function limparFormulario(){
    document.querySelector("#date").value="";
    document.querySelector("#txtprice").value="";
    document.querySelector("#txtidMovement").value="";     
}

function confirmarExcluir(idMovement) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirMovimento(idMovement);
    else 
        false;
}

function carregarMovimentos() {
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

function carregarContas() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            preencherComboBox(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", urlContas, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function preencherComboBox(contas){
    for(var i in contas){
        
        var opt0 = document.createElement("option");
        opt0.value = contas[i].idAccount;
        opt0.text = contas[i].accountName;
        comboContas.add(opt0, comboContas.options[i]);
        
    }
    
}

function montarTabela(movimentos) {

    var concat="";
    concat+= "<button type='button' class='btn btn-primary mt-5' id='btnNewMovement' data-toggle='modal' data-target='#newMovement'>Novo Movimento</button>"
    concat+= "<table class='table table-concatiped table-dark table-hover mt-5'>";
    concat+= "<tr>";
    concat+= "<th class='text-warning'>Nome da conta</th>";
    concat+= "<th class='text-warning'>Data Movimento</th>";
    concat+= "<th class='text-warning'>Preço</th>";
    concat+= "<th class='text-warning' colspan='2'>Ações</th>";
    concat+= "</tr>";

    for(var i in movimentos){
        concat+="<tr>";
        concat+="<td>" + movimentos[i].idAccount + "</td>";
        concat+="<td>" + movimentos[i].movementDate + "</td>";
        concat+="<td>" + movimentos[i].price + "</td>";
        concat+="<td onclick='editarMovimento(" + movimentos[i].idMovement + ")'<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#newMovement'>Editar</button></td>";
        concat+="<td onclick='confirmarExcluir(" + movimentos[i].idMovement + ")'<button type='button' class='btn btn-danger ml-2'>Deletar</button></td>";
        concat+="</tr>";
    } 
    concat+= "</table>";

    var tabela = document.querySelector("#showTableMovements");
    tabela.innerHTML = concat;
}


document.querySelector("#btnListMovement").addEventListener("click", function(){ carregarMovimentos()}); 

//document.querySelector("#newMovement").addEventListener("click", function(){ carregarContas()}); 
