<?php

class AccountController {

    public function getAccounts($req, $resp, $args) {
        $dao = new AccountDAO();
        $list = $dao->getAccounts();
        $resp = $resp->withJson($list);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getAccountsById($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new AccountDAO();
        $account = $dao->getAccountsById($id);
        $resp = $resp->withJson($account);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function insertAccount($req, $resp, $args) {
        $var = $req->getParsedBody();
        $account = new Account(0, $var["accountName"], $var["accountType"],
        $var["accountStatus"]);
        $dao = new AccountDAO();
        $dao->insertAccount($account);
        $resp = $resp->withJson($account);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function updateAccount($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $account = new Account($id, $var["accountName"], $var["accountType"], $var["accountStatus"]);
        $dao = new AccountDAO();
        $dao->updateAccount($account);
        $resp = $resp->withJson($account);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function updateAccountStatus($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new AccountDAO();
        $account = $dao->updateAccountStatus($id);
        $resp = $resp->withJson($account);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>