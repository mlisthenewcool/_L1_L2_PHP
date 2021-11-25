<?php
session_start();
require_once('includes/functions.php');
require_once('config/database.php');

if (isset($_POST['supprimer'])) {
    $errors = [];
    if (isset($_POST['id'])) {
        foreach($_POST['id'] as $value => $id) {
            $query = $db->prepare("DELETE FROM sites WHERE idSite = :id");
            $query->execute(
                [
                    'id' => $id
                ]
            );
        }
        set_flash("Le site de vente a bien été supprimé");
        //set_flash("Erreur lors de la suppression", "danger");
        redirect('editSite.php');
    }
    else {
        $errors [] = "Veuillez sélectionner un site";
    }
}

else if (isset($_POST['ajout'])) {
    if (not_empty(['nom', 'ville', 'longitude', 'latitude'])) {
        $errors = [] ;
        extract($_POST);

        if (mb_strlen($nom) < 2 ) {
            $errors [] = 'Nom trop court (Minimum 2 caractères)';
        }
        if (mb_strlen($ville) < 2 ) {
            $errors [] = 'Nom de ville trop court (Minimum 2 caractères)';
        }

        if (!is_numeric($longitude) || !is_numeric($latitude)) {
            $errors [] = 'Une longitude/latitude est composée uniquement de chiffres';
        }
        if (count($errors) === 0) {
            $query = $db->prepare('INSERT INTO sites (nom, ville, longitude, latitude) VALUES (:nom, :ville, :longitude, :latitude)');
            //$query->bindValue('nom', e($nom), PDO::PARAM_STR);
            //$query->bindValue('ville', e($ville), PDO::PARAM_STR);
            //$query->bindValue('longitude', e($longitude), PDO::PARAM_INT);
            //$query->bindValue('latitude', e($latitude), PDO::PARAM_INT);
            $query->execute(
                [
                    'nom' => e($nom),
                    'ville' => e($ville),
                    'longitude' => e($longitude),
                    'latitude' => e($latitude)
                ]
            );
            set_flash("Votre site a bien été ajouté");
            redirect('editSite.php');
        }
        else {
            save_input_data();
        }
    }
    else {
        $errors [] = "Veuillez remplir tous les champs !";
        save_input_data();
    }
}

else if (isset($_POST['modifier'])) {
    $errors = [];
    if (isset($_POST['id'])) {
        foreach($_POST['id'] as $value => $id) {
            $_SESSION['id'] = $id;
        }
        redirect('modifier.php');
    }
    else {
        $errors [] = "Veuillez sélectionner un site";
    }
}

else {
    clear_input_data();
}

require_once('views/voir.view.php');