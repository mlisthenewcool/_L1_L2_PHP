<?php
require_once('lib/Article.class.php');
require_once('lib/Caddie.class.php');
session_start();
require_once ('includes/functions.php');

//on récupère l'instance du caddie et on l'ajoute à une variable de session
$caddie = Caddie::getInstance();
if (isset($_SESSION['panier'])) {
    $caddie = $_SESSION['panier'];
}

if (isset($_POST['acheter'])) {
    if (isset($_POST['quantite'])) {
        $errors = [];
        extract($_POST);

        if ((int)$quantite === 0)
            $errors [] = 'Veuillez saisir une quantité valide';

        if (count($errors) === 0) {
            // On lit le fichier puis on stocke son contenu dans le tableau $articles
            $articles = getDataInFile('data/articles.txt');

            // On parcourt la table pour trouver l'article correspondant et l'ajouter au caddie
            foreach ($articles as $article) {
                if ($article->getReference() == $_GET['article']) {

                    $caddie->ajouter($article, (int) $quantite);
                    $_SESSION['panier'] = $caddie;

                    //On affiche un message de succes a l'utilisateur et on le redirige sur la page de commande
                    set_flash(
                        "L'article suivant :<br />" .
                        "Référence : " . $article->getReference() .
                        "<br />Désignation : " . $article->getDesignation() .
                        "<br />Prix unitaire : " . $article->getPrix() .
                        "<br />Quantité : " . $quantite .
                        "<br />a bien été ajouté au panier, merci", 'success');
                }
            }
            redirect('commander.php');
        }
    }
    else {
        save_input_data();
        $errors [] = 'Veuillez saisir une quantité';
    }
}
else
    clear_input_data();

require_once('views/acheter.view.php');