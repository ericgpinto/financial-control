<?php

require_once "header.php";

$app = new \Slim\App($config);

$app->post("/auth", "UserController:autenticar");

$app->group('/users',
	function() {
		$this->get('', UserController::class . ':getUsers');
		$this->get('/{id:[0-9]+}', UserController::class . ':getUsersById');
		$this->post('', UserController::class . ':insertUser'); 
		$this->put('/{id:[0-9]+}', UserController::class . ':updateUser');
		$this->delete('/{id:[0-9]+}', UserController::class . ':deleteUser');
	})
	->add("UserController::validarToken");

$app->group('/projects',
	function(){
		$this->get('', ProjectController::class . ':getProjects');
		$this->get('/{id:[0-9]+}', ProjectController::class . ':getProjectsById');
		$this->get('/simulation/{id:[0-9]+}', ProjectController::class . ':getSimulationByIdProject');
		$this->post('', ProjectController::class . ':insertProject');
		$this->put('/{id:[0-9]+}', ProjectController::class . ':updateProject');
		$this->delete('/{id:[0-9]+}', UserController::class . ':deleteProject');
	})
	->add("UserController::validarToken");

$app->group('/accounts',
	function(){
		$this->get('', AccountController::class . ':getAccounts');
		$this->get('/{id:[0-9]+}', AccountController::class . ':getAccountsById');
		$this->post('', AccountController::class . ':insertAccount');
		$this->put('/{id:[0-9]+}', AccountController::class . ':updateAccount');
		$this->put('/status/{id:[0-9]+}', AccountController::class . ':updateAccountStatus');
	})
	->add("UserController::validarToken");

$app->group('/movements',
	function(){
		$this->get('', MovementController::class . ':getMovements');
		$this->get('/{id:[0-9]+}', MovementController::class . ':getMovementsById');
		$this->post('', MovementController::class . ':insertMovement');
		$this->put('/{id}', MovementController::class . ':updateMovement');
		$this->delete('/{id}', MovementController::class . ':deleteMovement');
	})
	->add("UserController::validarToken");

$app->run();

?>