<?php

require_once("config.php");

// carrega um usuario usando o login e senha
$usuario = new usuario();

$usuario->loadById(8);

$usuario->update("professor", "verdao");

echo $usuario;

?>