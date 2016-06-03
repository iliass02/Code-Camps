<?php
// Si déjà une connexion active, fermeture de la connexion précédente
if (isset($link)) mysqli_close($link);

$base_host = 'localhost';
$username  = 'root';
$passwd    = '123';
$basename  = 'galerie';

$link = mysqli_connect($base_host, $username, $passwd, $basename);

if (mysqli_connect_errno()) {
	printf("Erreur de connexion: %s\n", mysqli_connect_error());
	exit();
}
// Prise en compte UTF8
mysqli_query($link, "SET NAMES 'UTF8'");
?>