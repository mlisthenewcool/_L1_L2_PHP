<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
    <h4 class="text-center">Découvrez notre trombinoscope</h4>

    <div class="jumbotron container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn btn-default col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3"
           href="<?= base_url(LOGIN_PATH_I . '1'); ?>">Accès étudiant
        </a>
        <br /><br />
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Modifier votre photo</p>
    </div>

    <div class="jumbotron container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn btn-default col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3"
           href="<?= base_url(LOGIN_PATH_I . '3') ?>">Accès professeur
        </a>
        <br /><br />
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Visualiser l'ensemble des groupes d'étudiants</p>
    </div>

    <div class="jumbotron container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn btn-default col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3"
           href="<?= base_url(LOGIN_PATH_I . '2') ?>">Accès administrateur
        </a>
        <br /><br />
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Administrer les groupes d'étudiants, exporter en PDF ou encore importer un CSV</p>
    </div>

</div>