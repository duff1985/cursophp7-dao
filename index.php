<?php

	require_once("config.php");

$user = new usuario();

$user->loadById(3);

echo $user;
?>