<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <?php if (count($groupes) > 0) : ?>
        <div class="table-responsive container col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th width="20%">N°</th>
                    <th width="40%">Libellé</th>
                    <th width="40%">Actions</th>
                </tr>
                </thead>
            </table>

            <div class="bodycontainer scrollable">
                <table class="table table-hover table-striped table-condensed table-scrollable">
                    <tbody>
                    <?php foreach ($groupes as $groupe) : ?>
                        <tr>
                            <td width="20%"><?= $groupe->getIdGroupe() ?></td>
                            <td width="40%"><?= $groupe->getLibelle() ?></td>
                            <td width="40%">
                                <a class="icone-table" href="<?= base_url (GROUPES_PATH_I . '2?id=' . $groupe->getIdGroupe()); ?>">
                                    <i class="fa fa-2x fa-edit" aria-hidden="true"></i>
                                </a>

                                <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce groupe ?')" class="icone-table" href="<?= base_url (GROUPES_PATH_I . '3?id=' . $groupe->getIdGroupe()); ?>">
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
        <?php echo form_open(GROUPES_PATH . '1', array('name' => "group_form",'id' => "group_form")); ?>
            <br />
            <fieldset>
                <div class="form-group">
                    <?php echo form_error('libelle'); ?>
                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="sr-only" for="libelle">Libellé : </label>
                        <input type="text" data-rules="required" placeholder="Libellé" class="form-control validate" id="libelle" name="libelle" value="<?= set_value('libelle');?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group col-">
                    <input type="submit" class="btn btn-default col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-1" value="Ajouter le groupe">
                </div>
            </fieldset>

        <?php echo form_close(); ?>
    </div>

    <?php else : ?>
        <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h5>Aucun groupe enregistré.</h5>
        </div>

        <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?php echo form_open(GROUPES_PATH . '1', array('name' => "group_form",'id' => "group_form")); ?>
            <br />
            <fieldset>
                <div class="form-group">
                    <?php echo form_error('libelle'); ?>
                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="sr-only" for="libelle">Libellé : </label>
                        <input type="text" data-rules="required" placeholder="Libellé" class="form-control validate" id="libelle" name="libelle" value="<?= set_value('libelle');?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group col-">
                    <input type="submit" class="btn btn-default col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-1" value="Ajouter le groupe">
                </div>
            </fieldset>

            <?php echo form_close(); ?>
        </div>
    <?php endif; ?>

</div>