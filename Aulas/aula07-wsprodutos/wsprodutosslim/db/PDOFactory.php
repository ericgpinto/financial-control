<?php
class PDOFactory {

    private static $pdo;

    // método estático para criação de conexão
    public static function getConexao() {
        
        if(!isset($pdo)) {
            /* usando o construtor do PDO devemos sempre adicionar a string 
            relativa ao Sistema Gerenciador de Banco de Dados (SGBD) a ser utilizado */
            //              banco:host=nomehost;dbname=nomedobanco  usuário senha
            $pdo = new PDO("mysql:host=localhost;dbname=wsprodutos","root", "");
            // indicação de atributos de inicialização da conexão com o SGBD
            // reportar erros relativos ao controle de exceção
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // indicação do modo padrão de retorno dos dados
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // conversão de valores numéricos para strings no retorno 
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            // emulação do "prepared statements"
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $pdo;
    }
}
?>