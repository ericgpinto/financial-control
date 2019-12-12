<?php
// inclui o cabeçalho com requires e configs
require_once "header.php";

$app = new \Slim\App($config);

// criação de rota de autenticação para geração de token
$app->post("/api/auth", "UsuarioController:autenticar");

$app->group('/api/motores', function(){
    $this->get('','MotorController:listar');
    $this->post('','MotorController:inserir');
    $this->get('/{id:[0-9]+}','MotorController:buscarPorId');
    $this->put('/{id:[0-9]+}','MotorController:atualizar');
    $this->delete('/{id:[0-9]+}','MotorController:deletar');
})
->add('UsuarioController:validarToken');

$app->run();
?>