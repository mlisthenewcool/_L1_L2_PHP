<?php
session_start();
require_once('config/database.php');
require_once('includes/functions.php');

if (isset($_POST['modifier'])) {
    if (not_empty(['nom', 'ville', 'longitude', 'latitude'])) {
        $errors = [] ;
        extract($_POST);

        if (mb_strlen($nom) < 2 ) {
            $errors [] = 'Nom trop court (Minimum 2 caractères)';
        }
        if ((int)$nom > 0) {
            $errors [] = 'Le nom ne peut pas être composé uniquement de chiffres';
        }
        if ((int)$ville > 0) {
            $errors [] = 'La ville ne peut pas être composé uniquement de chiffres';
        }
        if (mb_strlen($ville) < 2 ) {
            $errors [] = 'Nom de ville trop court (Minimum 2 caractères)';
        }
        if (!is_numeric($longitude) || !is_numeric($latitude)) {
            $errors [] = 'Une longitude/latitude est composée uniquement de chiffres';
        }
        if (count($errors) === 0) {
            $query = $db->prepare('UPDATE sites SET nom=:nom, ville=:ville, latitude=:latitude, longitude=:longitude WHERE idSite=:id');
            $query->execute(
                [
                    'nom' => e($nom),
                    'ville' => e($ville),
                    'longitude' => e($longitude),
                    'latitude' => e($latitude),
                    'id' => $_SESSION['id']
                ]
            );
            set_flash("Le site de vente a bien été mis à jour");
            redirect('editSite.php');
        }
        else
            save_input_data();
    }
    else {
        $errors [] = "Veuillez remplir tous les champs !";
        save_input_data();
    }
}

else
    clear_input_data();

require_once('views/modifier.view.php');