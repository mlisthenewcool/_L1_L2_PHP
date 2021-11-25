<?php
require_once('lib/Caddie.class.php');
require_once('lib/Article.class.php');
session_start();
require_once ('includes/functions.php');

/*
 * EDITER DU CODE ICI POUR EFFECTUER DES TESTS
 */
// On crée un caddie et des articles pour tester
//$caddie = Caddie::getInstance();
//$_SESSION['panier'] = $caddie;

//$art1 = new Article(1, 'test1', 10);
//$art2 = new Article(2, 'test2', 20);

//$caddie->ajouter($art1, 5);
//$caddie->ajouter($art2, 6);
//$caddie->ajouter($art2, 6);

//$caddie->afficher();

/*
 * VIDER LA SESSION
 */
//session_destroy();

echo '<pre>';
print_r ($_SESSION);
echo '</pre>';

require_once('views/caddie.view.php');