<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 22:31
 */

class usuarios
{
    private $id;
    private $login;
    private $password;

    /**
     * usuariosDAO constructor.
     * @param $id
     */
    public function __construct()
    {

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}