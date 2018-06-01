<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 22:31
 */
require_once("conexao.php");
class usuarios
{

    public function login(){
        global $pdo;

    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $username = "'".$username."'";
        $password = "'".$password."'";

        $statement = $pdo->prepare("SELECT * FROM db_eca.tb_usuarios as a  WHERE a.login_usuarios = ? AND a.password_usuarios = ?;");
        $statement->bindParam(1,$username);
        $statement->bindParam(1,$password);
        if ($statement->execute()) {
            if ($statement->rowCount() > 0) {
                session_start();

                $_SESSION['username'] = $username;

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