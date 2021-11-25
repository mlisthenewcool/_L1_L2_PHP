<?
if ( ! empty($_SESSION['id_prof']))
	$_SESSION['id_prof'] = NULL;

else if ( ! empty($_SESSION['id_admin']))
	$_SESSION['id_admin'] = NULL;

session_destroy();
header('Location: https://infodb.iutmetz.univ-lorraine.fr/~debernar2u/tutore/index.php');