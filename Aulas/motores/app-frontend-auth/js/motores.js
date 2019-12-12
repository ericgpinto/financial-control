
// Definir URL padrão do web service que será chamada nas funções
var url = "http://localhost/app/app-motores/api/motores";

// Selecionando o body no DOM (Document Object Model)
var body = document.querySelector("body");

// Evento de carregamento da página atual
body.onload = function () {
    // Chamar a função de visualização dos dados
    // Método GET
    carregarMotores();
}

// Selecionando o elemento cujo ID é "formulario"
var form = document.querySelector("#formulario");

// Evento de submeter o formulário 
form.onsubmit = function(event){
    event.preventDefault();
 
    // Criação de um objeto JSON
    var motor = {};
 
    // Cada atributo busca por JS o ID do input e associa ao valor digitado 
    motor.nome = document.querySelector("#txtnome").value;
    motor.imagem = document.querySelector("#txtimagem").value;
    motor.descricao = document.querySelector("#txtdescricao").value;
    motor.uso = document.querySelector("#txtuso").value;
    
    // Atributo ID só vai ter valor quando for um caso de EDIÇÃO (PUT)
    // Quando for um caso de CRIAÇÃO (POST) será nulo
    var id = document.querySelector("#txtid").value;
    
    // Se o ID estiver vazio então é uma CRIAÇÃO (POST)
    // Se o ID *não* estiver vazio então é uma EDIÇÃO (PUT) e precisa do ID
    if(id == "") 
        enviarMotor(motor);
    else
        atualizarDadosMotor(motor, id);
}

// Processo de inserção de dados digitados no formulário
// Método POST
function enviarMotor(motor){
    // Instancia a classe de requisições assíncronas (AJAX)
    var xhttp = new XMLHttpRequest();

    
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log("Response recebido!");
            limparFormulario();
            carregarMotores();
        }
    };
    xhttp.open("POST", url, true);
    // Passando um cabeçalho com tipo de dados JSON
    xhttp.setRequestHeader("Content-Type","application/json");
    // AUTH: realiza a autorização com token
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(motor));
}

// Busca os dados do registro atual para que sejam mostrados no 
// formulário e posteriormente editados pelo usuário
// Método GET{id}
function editarMotor(id) {

    // Instancia a classe de requisições assíncronas (AJAX)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var motor = JSON.parse(this.responseText);
            document.querySelector("#txtnome").value = motor.nome;
            document.querySelector("#txtimagem").value =  motor.imagem;
            document.querySelector("#txtdescricao").value = motor.descricao;
            document.querySelector("#txtuso").value = motor.uso;
            document.querySelector("#txtid").value = id;
        }
    };
    // Concatena a URL padrão do Web Service com /id
    xhttp.open("GET", url + "/" + id, true);
    // AUTH: realiza a autorização com token
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

// Edição dos dados no Web Service passando os dados e o ID
// Método PUT 
function atualizarDadosMotor(motor, id){

    // Instancia a classe de requisições assíncronas (AJAX)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
    
       if (this.readyState === 4 && this.status === 200) {            
            console.log("Response recebido!");
            limparFormulario();
            carregarMotores();
        }
    };
    // Concatena a URL padrão do Web Service com /id
    xhttp.open("PUT", url + "/" + id, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    // AUTH: realiza a autorização com token
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send(JSON.stringify(motor));
}

// Procedimento de exclusão de dados via Web Service passando ID
// Método DELETE 
function excluirMotor(id) {

    // Instancia a classe de requisições assíncronas (AJAX)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarMotores();
        }
    };
    // Concatena a URL padrão do Web Servic com /id
    xhttp.open("DELETE", url + "/" + id, true);

    // AUTH: realiza a autorização com token
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function limparFormulario(){
    document.querySelector("#txtnome").value="";
    document.querySelector("#txtimagem").value="";
    document.querySelector("#txtdescricao").value="";
    document.querySelector("#txtuso").value="";  
    document.querySelector("#txtid").value="";     
}

// Confirmação de exclusão do registro
function confirmarExcluir(id) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirMotor(id);
    else 
        false;
}

// Função para recuperação de dados do web service
// Método GET e usar a função montarTabela com a estrutura JSON
function carregarMotores() {
    // Instancia a classe de requisições assíncronas (AJAX)
    var xhttp = new XMLHttpRequest();
    // Etapa 3: quando a requisição dá uma resposta 
    //          e chegar no estado de pronto, executa a função 
    xhttp.onreadystatechange = function () {
        // Estado de pront e status OK (conseguiu recuperar os dados)
        if (this.readyState === 4 && this.status === 200) {
            // Enviar os dados recuperados convertendo para JSON
            montarTabela(JSON.parse(this.responseText));
        }
    };
    // Etapa 1: prepara a requisição com método (GET, POST, PUT, DELETE)
    //          a URL onde está o Web Service e se é assíncrono ou não
    xhttp.open("GET", url, true);

    // AUTH: realiza a autorização com token
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));

    // Etapa 2: enviar a requisição preparada anteriormente
    xhttp.send();
}

// Recebe a estrutura JSON que veio a partir da requisição (GET)
function montarTabela(motores) {

    var str="";
    str+= "<table>";
    str+= "<tr>";
    str+= "<th>Nome</th>";
    str+= "<th>Imagem</th>";
    str+= "<th>Descrição</th>";
    str+= "<th>Uso</th>";
    str+= "<th colspan='2'>Ações</th>";
    str+= "</tr>";

    // Iteração no JSON criando uma linha para cada registro
    for(var i in motores){
        str+="<tr>";
        str+="<td>" + motores[i].nome + "</td>";
        str+="<td>" + motores[i].imagem + "</td>";
        str+="<td>" + motores[i].descricao + "</td>";
        str+="<td>" + motores[i].uso + "</td>";
        // Construção de botões de ação para Edição e Exclusão passando o ID do registro
        str+="<td onclick='editarMotor(" + motores[i].id + ")' class='beditar'>Editar</a></td>";
        str+="<td onclick='confirmarExcluir(" + motores[i].id + ")' class='bexcluir'>Excluir</a></td>";
        str+="</tr>";
    } 
    str+= "</table>";

    // Buscando no documento HTML o ID com valor "tabela"
    var tabela = document.querySelector("#tabela");
    // Inserindo os dados concatenados no interior do elemento ID valor "tabela"
    tabela.innerHTML = str;
}
