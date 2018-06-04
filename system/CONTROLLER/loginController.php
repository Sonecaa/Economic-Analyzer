<?php

require_once("../DAO/usuariosDAO.php");

$daoUsuarios = new usuariosDAO();

$daoUsuarios->login($_POST['username'], $_POST['password']);

?>
