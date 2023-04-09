<?php
require "app.php";

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL."/${nombre}.php";
}

function estaAutenticado(): bool{
    session_start();
/*SI NO TE AUTENTIFICAS LA URL TE LLEVARA AL HOME*/
$auth = $_SESSION["login"];
if($auth){
    return true;
}
return false; //SI HAY UN RETURN NO ES NECESARIO UN ELSE

}