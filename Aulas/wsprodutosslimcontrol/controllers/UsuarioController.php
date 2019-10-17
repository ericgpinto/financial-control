<?php
use \Firebase\JWT\JWT;

class UsuarioController {

   

    public function autenticar($req, $resp, $args) {

        $secretKey = "f0d@";

        $var = $req->getParsedBody();

        $dao = new UsuarioDao();
        $usuario = $dao->buscarPorLogin($var["login"]);

        if ($usuario == false) {
            return $resp->withStatus(401);
        } else {

            if($usuario->senha == $var["senha"]){
                $tokenpayload = array(
                    "usuario_id" => $usuario->id,
                    "usuario_nome" => $usuario->nome
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