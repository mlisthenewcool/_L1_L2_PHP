<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1 style="text-align: center" >Authenfication pour les étudiants</h1>

<?php foreach ($groupes_selected as $groupe) : ?>

    <h3 style="text-align: center">Groupe <?= $groupe->getLibelle() ?></h3>
    <h4>--------------------------------------------------------------------------------------------------------------------------------------</h4>
    <?php $compt = 0;
        foreach ($groupe->getEtudiants() as $etudiant):
            $compt++;
            if($compt == 6) {
                echo'<br pagebreak="true"/>';
                $compt = 0;
            }
    ?>
            <h3><?= $etudiant->getPrenom() . '  '  . $etudiant->getNom() ?></h3>

            <h4>https://infodb.iutmetz.univ-lorraine.fr/~debernar2u/trombinoscope/</h4>

            <h4>Login : <?= $etudiant->getLogin() ?></h4>

            <h4>Mot de passe : <?= $etudiant->getPassword() ?></h4>

            <h4>-------------------------------------------------------------------------------------------------------------------------------------</h4>
        <?php endforeach; ?>

<?php endforeach;


 