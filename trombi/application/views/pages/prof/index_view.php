<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <?php if (count($groupes) < 1)
        echo "<h5>Il n'existe aucun étudiant pour le moment.</h5>";

    foreach($groupes as $groupe) :
        if ( count($groupe->getEtudiants()) < 1) : ?>
            <p>Le groupe <?= $groupe->getLibelle(); ?> est vide.</p>
        <? endif;
    endforeach;
    ?>

    <?php foreach($groupes as $groupe) :
        if ( count($groupe->getEtudiants()) > 0) : ?>
            <button class="btn btn-default" data-toggle="collapse" data-target="#demo<?= $groupe->getIdGroupe(); ?>">Groupe <?= $groupe->getLibelle() ?></button>

            <div id="demo<?= $groupe->getIdGroupe(); ?>" class="collapse panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center">
                        Groupe <?= $groupe->getLibelle(); ?>
                    </h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach ($groupe->getEtudiants() as $etudiant) : ?>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <div class="thumbnail">
                                    <img src="<?= base_url('images/' . $etudiant->getPhoto()) ?>" class="img-responsive" alt=""/>
                                    <div class="caption">
                                        <h6 class="text-center"><?= $etudiant->getPrenom() ?></h6>
                                        <h6 class="text-center"><?= $etudiant->getNom() ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <? endif;
    endforeach; ?>

</div><!-- container -->