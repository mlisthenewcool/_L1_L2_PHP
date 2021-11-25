<?php
load_view('accueil');

require_once 'libraries/app/personne.php';
require_once 'libraries/app/etudiant.php';
require_once 'libraries/app/promotion.php';

$etudiant = new Etudiant();

//$etudiant->set_prenom('Jean');
//$etudiant->set_nom('Zakari');
$etudiant->get_promotion()->set_libelle('test');

require_once 'models/model.php';
require_once 'models/etudiant.php';
$etudiant_model = new Etudiant_model();

//echo '<pre>';
//print_r($etudiant_model->create($etudiant));
//echo '</pre>';