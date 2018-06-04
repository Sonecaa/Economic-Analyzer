<?php

if(isset($_SESSION['usuario'])){
   echo "<h6> Login: ".  $_SESSION['usuario']->login_usuarios. " <a href='#'>Logout</a></h6>";
    if($_SESSION['usuario']->tipo_usuario = true){
        echo "<h6> Sem permissão</h6>";
    }else{
        echo "<h6>Com permissão</h6>";
    }
}



?>