<?php

class UsuarioController {

    public function listar($req, $resp, $args) {
        $dao = new simulacaoDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new simulacaoDAO();
        $simulacao = $dao->buscarPorId($id);
        $resp = $resp->withJson($simulacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $simulacao = new simulacao(0, $var["Movimentos_idMovimento"], $var["Projetos_idProjeto"],
                                   $var["dataSimulacao"], $var["total"]);
        $dao = new simulacaoDAO();
        $dao->inserir($simulacao);
        $resp = $resp->withJson($simulacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function atualizar($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $simulacao = new simulacao($id, $var["Movimentos_idMovimento"],
                                   $var["Projetos_idProjeto"],$var["dataSimulacao"], $var["total"]);
        $dao = new simulacaoDAO();
        $dao->atualizar($simulacao);
        $resp = $resp->withJson($simulacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new simulacaoDAO();
        $simulacao = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($simulacao);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>