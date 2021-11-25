<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <h5 class="text-center">How it works</h5>

    <div class="jumbotron container col-lg-6 col-md-6">
        <a class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12"
           href="<?= base_url(GROUPES_PATH_I); ?>">Groupes
        </a>
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Rechercher, ajouter, modifier, supprimer les groupes</p>
    </div>

    <div class="jumbotron container col-lg-6 col-md-6">
        <a class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12"
           href="<?= base_url(ETUDIANTS_PATH_I) ?>">Etudiants
        </a>
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Rechercher, ajouter, modifier, supprimer les étudiants</p>
    </div>

    <div class="jumbotron container col-lg-6 col-md-6">
        <a class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12"
           href="<?= base_url(PDF_PATH_I) ?>">Exporter PDF
        </a>
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Sélection des groupes, aperçu et export au format PDF</p>
    </div>

    <div class="jumbotron container col-lg-6 col-md-6">
        <a class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12"
           href="<?= base_url(CSV_PATH_I) ?>">Import CSV
        </a>
        <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">Importer des groupes d'étudiants depuis un fichier CSV</p>
    </div>
</div>