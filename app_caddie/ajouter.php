<?php
session_start();
require_once ('includes/functions.php');
require_once('lib/Article.class.php');

if (isset($_POST['ajouter'])) {
    if (isset($_POST['designation']) && isset($_POST['prix'])) {
        $errors = [];
        extract($_POST);

        if ((int) $prix === 0) {
            $errors [] = 'Veuillez saisir un prix valide';
        }
        if ((int)($designation) > 0 || $designation === '0') {
            $errors [] = 'Veuillez saisir une désignation valide';
        }
        if (count($errors) === 0) {
            // On lit le fichier puis on stocke son contenu dans le tableau $articles
            $articles = getDataInFile('data/articles.txt');

            // On ajoute l'article saisi au tableau deja existant
            $art = new Article(count($articles)+1, htmlspecialchars($designation), htmlspecialchars($prix));
            $articles[] = $art;

            // On réécrit le tableau dans le fichier
            $serial = serialize($articles);
            file_put_contents('data/articles.txt', $serial);

            // On affiche un message de succes a l'utilisateur et on le redirige sur la page d'ajout d'articles
            set_flash("L'article a bien été ajouté", 'success');
            redirect('ajouter.php');
        }
        else
            save_input_data();
    }
    else {
        save_input_data();
        $errors [] = 'Veuillez remplir tous les champs ';
    }
}
else
    clear_input_data();

require_once('views/ajouter.view.php');