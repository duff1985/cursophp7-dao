<?php

require_once("config.php");

// carrega um usuario usando o login e senha
$usuario = new usuario();

$usuario->login("hermes","abcde");

echo $usuario;

?>