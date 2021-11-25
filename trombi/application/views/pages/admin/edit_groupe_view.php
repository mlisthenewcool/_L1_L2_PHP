<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <?php if (isset ($groupe[0]) && count($groupe[0]->getEtudiants()) > 0 ) : ?>
        <div class="table-responsive container col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h5 class="text-center">Liste des étudiants du groupe</h5>
            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
            <div class="bodycontainer scrollable">
                <table class="table table-hover table-striped table-condensed table-scrollable">
                    <tbody>
                    <?php foreach ($groupe[0]->getEtudiants() as $etudiant) : ?>
                        <tr>
                            <td><?= $etudiant->getIdEtudiant() ?></td>
                            <td><?= $etudiant->getPrenom() ?></td>
                            <td><?= $etudiant->getNom() ?></td>
                            <td>
                                <a class="icone-table" href="<?= base_url (ETUDIANTS_PATH_I . '2?id=' . $etudiant->getIdEtudiant()); // $groupe[0]->getIdGroupe()); . '&et=' . $etudiant[0]->getIdEtudiant()); ?>">
                                    <i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                                </a>

                                <a class="icone-table" href="<?= base_url (ETUDIANTS_PATH_I . '3?id=' . $etudiant->getIdEtudiant()); // $groupe[0]->getIdGroupe()); . '&et=' . $etudiant[0]->getIdEtudiant()); ?>">
                                    &emsp;<i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!--
            <table class="table table-hover table-striped table-condensed">
                <tfoot>
                < ajouter un footer ici >
                </tfoot>
            </table>
            -->
        </div>
    <?php else : ?>
        <div class="container col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <br /><br /><br />
            <h5 class="text-center" style="color: red">Ce groupe ne contient aucun étudiant</h5>
        </div>
    <?php endif; ?>

    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <br />
        <div class="row">
            <?php echo form_open(GROUPES_PATH, array('method' => 'get','name' => "recherche_groupe_form",'id' => "recherche_groupe_form")); ?>
            <div class="input-group recherche-input-group">
                <?php echo form_error('recherche'); ?>
                <input type="text" data-rules="required" value="<?= set_value('recherche');?>" class="form-control validate" id="recherche" name="recherche" placeholder="Rechercher un groupe">
                <p class="help-block"></p>
                <span class="input-group-addon">
                    <button type="submit"><!-- disabled -->
                        <span class="fa fa-2x fa-search"></span>
                    </button>
                </span>
            </div>
            <?php echo form_close(); ?>
        </div>
        <br />
    </div>

    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <br />
        <div class="row">
            <?php echo form_open(ETUDIANTS_PATH, array('method' => 'get','name' => "recherche_etudiant_form",'id' => "recherche_etudiant_form")); ?>
            <div class="input-group recherche-input-group">
                <?php echo form_error('recherche'); ?>
                <input type="text" data-rules="required" value="<?= set_value('recherche');?>" class="form-control validate" id="recherche" name="recherche" placeholder="Rechercher un étudiant">
                <p class="help-block"></p>
                <span class="input-group-addon">
                    <button type="submit"><!-- disabled -->
                        <span class="fa fa-2x fa-search"></span>
                    </button>
                </span>
            </div>
            <?php echo form_close(); ?>
        </div>
        <br />
    </div>

    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <br /><br />
        <?php echo form_open(GROUPES_PATH . '2?id=' . $groupe[0]->getIdGroupe(), array('name' => "group_form", 'id' => "group_form")); ?>
        <fieldset>
            <div class="form-inline">
                <div class="form-group col-lg-6 col-md-6">
                    <?php echo form_error('libelle'); ?>
                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="sr-only" for="libelle">Libellé : </label>
                        <input type="text" data-rules="required" class="form-control validate" id="libelle" name="libelle" value="<?= $groupe[0]->getLibelle() ?>">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="form-group col-lg-6 col-md-6">
                    <input type="submit" class="btn btn-default" value="Modifer le libellé">
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>

    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <br /><br />
        <?php echo form_open(GROUPES_PATH . '4?id=' . $groupe[0]->getIdGroupe(), array('name' => "student_form",'id' => "student_form")); ?>
        <fieldset>
            <div class="form-group">
                <?php echo form_error('prenom'); ?>
                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="sr-only" for="prenom">Prénom : </label>
                    <input type="text" data-rules="required|min_length[2]" placeholder="Prénom" class="form-control validate" id="prenom" name="prenom" value="<?= set_value('prenom');?>">
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_error('nom'); ?>
                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="sr-only" for="nom">Nom : </label>
                    <input type="text" data-rules="required|min_length[2]" id="nom" placeholder="Nom" class="form-control validate" name="nom" value="<?= set_value('nom');?>">
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="form-group">
                <div class="input group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="submit" class="btn btn-default" value="Ajouter un étudiant">
                </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>