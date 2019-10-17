<?php

class MovementController {

    public function getMovements($req, $resp, $args) {
        $dao = new MovementDAO();
        $lista = $dao->getMovements();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getMovementsById($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new MovementDAO();
        $movement = $dao->getMovementsById($id);
        $resp = $resp->withJson($movement);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getSimulationByIdProject($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new MovementDAO();
        $project = $dao->getSimulationByIdProject($id);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getAccontJoinMovement() {
        $dao = new MovementDAO();
        $lista = $dao->getMovements();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function insertMovement($req, $resp, $args) {
        $var = $req->getParsedBody();
        $movement = new Movement(0, $var["idAccount"],$var["movementDate"], $var["price"]);
        $dao = new MovementDAO();
        $dao->insertMovement($movement);
        $resp = $resp->withJson($movement);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function updateMovement($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $movement = new Movement($id, $var["idAccount"],$var["movementDate"],$var["price"]);
        $dao = new MovementDAO();
        $dao->updateMovement($movement);
        $resp = $resp->withJson($movement);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deleteMovement($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new MovementDAO();
        $movement = $dao->getMovementsById($id);
        $dao->deleteMovement($id);
        $resp = $resp->withJson($movement);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>