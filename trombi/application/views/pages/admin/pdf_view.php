<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <!-- navigation des groupes -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-groupe">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>

            <div class="collapse navbar-collapse" id="nav-groupe" style="padding-top: 1.5%">
                <?php echo form_open(PDF_PATH); ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php foreach ($groupes as $groupe) :
                            if ( count($groupe->getEtudiants()) > 0) : ?>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="groupes[]" name="groupes[]" value="<?= $groupe->getIdGroupe() ?>">
                                        <?= $groupe->getLibelle() ?>
                                    </label>
                                </div>
                            <?php endif;
                        endforeach; ?>
                    </div>

                    <div class="container well col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: white">
                        <input type="submit" name="trombi" class="btn btn-default" value="Exporter le trombinoscope">
                        <input type="submit" name="auth" class="btn btn-default" value="Exporter les accès login/password">
                    </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </nav>
    <!-- fin navigation des groupes -->

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
                        <a class="icone-table" href="<?= base_url (GROUPES_PATH_I . '2?id=' . $groupe->getIdGroupe()); ?>">
                            &emsp;<i class="fa fa-edit" aria-hidden="true"></i>
                        </a>

                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce groupe ?')" class="icone-table" href="<?= base_url (GROUPES_PATH_I . '3?id=' . $groupe->getIdGroupe()); ?>">
                            &emsp;<i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach ($groupe->getEtudiants() as $etudiant) : ?>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                <div class="thumbnail">
                                    <a href="<?= base_url (ETUDIANTS_PATH_I . '2?id=' . $etudiant->getIdEtudiant()); ?>">
                                        <img src="<?= base_url('images/' . $etudiant->getPhoto()) ?>" class="img-responsive" alt=""/>
                                    </a>
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