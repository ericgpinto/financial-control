<?php
use \Firebase\JWT\JWT;

class UserController {

    public function getUsers($req, $resp, $args) {
        $dao = new UserDAO();
        $list = $dao->getUsers();
        $resp = $resp->withJson($list);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function getUsersById($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new UserDAO();
        $usuario = $dao->getUsersById($id);
        $resp = $resp->withJson($usuario);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function insertUser($req, $resp, $args) {
        $var = $req->getParsedBody();
        $user = new User(0, $var["name"], $var["login"], $var["password"],0);
        $dao = new UserDAO();
        $dao->insertUser($user);
        $resp = $resp->withJson($user);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function updateUser($req, $resp, $args) {
        $id = (int) $args["id"];
        $var = $req->getParsedBody();
        $user = new User($id, $var["name"], $var["login"], $var["password"],$var["active_status"]);
        $dao = new UserDAO();
        $dao->updateUser($user);
        $resp = $resp->withJson($user);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deleteUser($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new UserDAO();
        $user = $dao->getUsersById($id);
        $dao->deleteUser($id);
        $resp = $resp->withJson($user);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function autenticar($req, $resp, $args) {

        $secretKey = "f0d@";

        $var = $req->getParsedBody();

        $dao = new UserDAO();
        $usuario = $dao->getByLogin($var["login"]);

        if ($usuario == false) {
            return $resp->withStatus(401);
        } else {

            if($usuario->password == $var["password"]){
                $tokenpayload = array(
                    "idUser" => $usuario->idUser,
                    "name" => $usuario->name
                );

            $token = JWT::encode($tokenpayload, $secretKey);

            return $resp->withJson(["token" => $token], 201)
                        ->withHeader("Content-type","application/json");

            }   
        }      
    }

    public function validarToken($req, $resp, $next){

        $secretKey = "f0d@";

        $token = str_replace("Bearer ","", $req->getHeader('Authorization')[0]);

        if($token) {
            
            try {
                $decoded = JWT::decode($token, $secretKey, array("HS256"));
                if ($decoded) {
                    return($next($req, $resp));
                }

            } catch (Exception $error) {
                return $resp->withStatus(401);
            }
        }
        return $resp->withStatus(401);
    }
}

?>