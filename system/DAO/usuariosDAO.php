<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 22:31
 */
require_once("conexao.php");
class usuariosDAO
{

    public function login($username, $password){
        $pdo = $GLOBALS['pdo'];
    if(!empty($username) && !empty($password))
    {
        $username = trim($username);
        $password = trim($password);

        $username = $username;
        $password =$password;

        $statement = $pdo->prepare("SELECT * FROM db_eca.tb_usuarios as a  WHERE a.login_usuarios = ? AND a.password_usuarios = ?;");
        $statement->bindParam(1,$username);
        $statement->bindParam(2,$password);
        if ($statement->execute()) {
            if ($statement->rowCount() > 0) {
                $x = $statement->fetch(PDO::FETCH_OBJ);
                session_start();

                $_SESSION['usuario'] = $x;

                return true;
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    }else{
        return false;
    }



    }


}