function manipularProjeto() {
    location.href = "projects.html";
}

function manipularConta() {
    location.href = "accounts.html";
}

function manipularMovimento() {
    location.href = "movements.html";
}

document.querySelector("#projectBtn").addEventListener("click", function(){ manipularProjeto()});
document.querySelector("#accountBtn").addEventListener("click", function(){ manipularConta()});
document.querySelector("#movBtn").addEventListener("click", function(){ manipularMovimento()});