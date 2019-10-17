<?php

class ProjectController {

    public function getProjects($req, $resp, $args) {
        $dao = new ProjectDAO();
        $list = $dao->getProjects();
        $resp = $resp->withJson($list);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getSimulationByIdProject($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ProjectDAO();
        $project = $dao->getSimulationByIdProject($id);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getProjectsById($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ProjectDAO();
        $project = $dao->getProjectsById($id);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function insertProject($req, $resp, $args) {
        $var = $req->getParsedBody();
        $project = new Project(0,$var["idUser"], $var["description"], $var["creationDate"],
                               $var["realizationDate"], $var["price"]);
        $dao = new ProjectDAO();
        $dao->insertProject($project);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function updateProject($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $project = new Project($id, $var["idUser"], $var["description"], $var["creationDate"],
                               $var["realizationDate"], $var["price"]);
        $dao = new ProjectDAO();
        $dao->updateProject($project);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deleteProject($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ProjectDAO();
        $project = $dao->getProjectsById($id);
        $dao->deleteProject($id);
        $resp = $resp->withJson($project);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>