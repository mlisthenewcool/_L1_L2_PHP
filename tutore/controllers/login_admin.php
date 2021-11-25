<?php
session_start();
$login = $_POST['login_admin'];
$password = $_POST['password_admin'];

/* Les deux champs sont vides */
if (empty ($login) && empty ($password))
	echo json_encode(array('reponse' => 'Les champs login et password sont requis'));

/* Le login est vide */
else if (empty ($login))
	echo json_encode(array('reponse' => 'Le champ login est requis'));

/* Le password est vide */
else if (empty ($password))
	echo json_encode(array('reponse' => 'Le champ password est requis'));

/* Les champs sont remplis */
else
{
	require_once 'models/model.php';
	require_once 'models/login.php';
	$login_model = new Login_model();

	/* Erreur MySQL */
	if (($retour = $login_model->connexion($login, $password, 'administrateur')) === -1)
		echo json_encode(array('reponse' => 'Erreur MySQL'));

	/* Connnexion OK */
	elseif ($retour > 0)
	{
		$_SESSION['id_admin'] = $retour;
		echo json_encode(array('reponse' => 'ok', 'redirect' => 'index.php/?p=admin'));
	}

	/* Erreur d'authentification */
	else
		echo json_encode(array('reponse' => "Erreur d'authentification"));
}