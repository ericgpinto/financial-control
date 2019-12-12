var url = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/projects";

var url02 = "http://localhost/Programacao_Internet_II/ControleFinanceiro/Api-ControleFinanceiro/projects/simulation";

var listProj = document.querySelector("#btnListProject");

var form = document.querySelector("#form-proj");

form.onsubmit = function(event){
    event.preventDefault();
 
    var projeto = {};

    projeto.idUser = 4;
    projeto.description = document.querySelector("#txtdesc").value;
    projeto.creationDate = document.querySelector("#creationDate").value;
    projeto.realizationDate = document.querySelector("#realizationDate").value;
    projeto.price = document.querySelector("#price").value;
    projeto.statusProjeto = document.querySelector("#btnSimulation").value;
    
    console.log(JSON.stringify(projeto));

    var idProject = document.querySelector("#txtidProject").value;
    var idUsuario = document.querySelector("#txtidUser").value;
    console.log(idUsuario);
    
    if(idProject == "") 
        enviarProjeto(projeto);
    else
        atualizarDadosProjeto(projeto, idProject);
}

function enviarProjeto(projeto){
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log("Response recebido!");
            limparFormulario();
            carregarProjetos();
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(projeto));
}

function editarProjeto(idProject) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var projeto = JSON.parse(this.responseText);
            document.querySelector("#txtdesc").value = projeto.description;
            document.querySelector("#creationDate").value =  projeto.creationDate;
            document.querySelector("#realizationDate").value = projeto.realizationDate;
            document.querySelector("#price").value = projeto.price;
            document.querySelector("#txtidProject").value = idProject;
        }
    };
    xhttp.open("GET", url + "/" + idProject, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function simularProjeto(idProject) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            var project = JSON.parse(this.responseText);
            document.querySelector("#btnSimulation").value = project.statusProjeto;
            var simulation = document.querySelector("#showSimulation");
            simulation.innerHTML = project.statusProjeto;
        }
    };
    xhttp.open("GET", url02 + "/" + idProject, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
    
}

function atualizarDadosProjeto(projeto, idProject){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
    
       if (this.readyState === 4 && this.status === 200) {            
            console.log("Response recebido!");
            limparFormulario();
            carregarProjetos();
        }
    };
    xhttp.open("PUT", url + "/" + idProject, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(projeto));
}

function excluirProjeto(idProject) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarProjetos();
        }
    };
    xhttp.open("DELETE", url + "/" + idProject, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function limparFormulario(){
    document.querySelector("#txtdesc").value="";
    document.querySelector("#creationDate").value="";
    document.querySelector("#realizationDate").value="";
    document.querySelector("#price").value="";  
    document.querySelector("#txtidProject").value="";     
}

function confirmarExcluir(idProject) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirProjeto(idProject);
    else 
        false;
}

function carregarProjetos() {
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

function montarTabela(projetos) {

    var str="";
    str+= "<button type='button' class='btn btn-success mt-5' id='btnNewProject' data-toggle='modal' data-target='#newProject'>Novo Projeto</button>"
    
    str+= "<table class='table table-striped table-dark table-hover mt-5'>";
    str+= "<tr>";
    str+= "<th class='text-warning'>Descrição</th>";
    str+= "<th class='text-warning'>Data Criação</th>";
    str+= "<th class='text-warning'>Data Realização</th>";
    str+= "<th class='text-warning'>Preço</th>";
    str+= "<th class='text-warning'colspan='3'>Ações</th>";
    str+= "</tr>";

    for(var i in projetos){
        str+="<tr>";
        str+="<td>" + projetos[i].description + "</td>";
        str+="<td>" + projetos[i].creationDate + "</td>";
        str+="<td>" + projetos[i].realizationDate + "</td>";
        str+="<td>" + projetos[i].price + "</td>";
        str+="<td onclick='editarProjeto(" + projetos[i].idProject + ")'<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#newProject'>Editar</button></td>";
        str+="<td onclick='confirmarExcluir(" + projetos[i].idProject + ")'<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#newProject'>Deletar</button</td>";
        str+="<td onclick='simularProjeto("+ projetos[i].idProject + ")'<button type='button' class='btn btn-success' id='btnSimulation' data-toggle='modal' data-target='#getSimulation'>Simular</button>"
        str+="</tr>";
    } 
    str+= "</table>";

    var tabela = document.querySelector("#showTableProjects");
    tabela.innerHTML = str;


}

document.querySelector("#btnListProject").addEventListener("click", function(){ carregarProjetos()});