<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
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

    <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
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

    <?php if (isset ($etudiant[0])) : ?>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                <div class="thumbnail">
                    <img src="<?= base_url(IMAGE_PATH . $etudiant[0]->getPhoto()); ?>" class="img-responsive" alt=""/>
                </div>
            </div>

            <div class="container col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php echo form_open(ETUDIANTS_PATH . '2?id=' . $etudiant[0]->getIdEtudiant(), array('name' => "student_form",'id' => "student_form")); ?>
                    <fieldset>
                        <div class="form-group">
                            <?php echo form_error('prenom'); ?>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Prénom</b>
                                </span>
                                <label class="sr-only" for="prenom">Prénom : </label>
                                <input type="text" data-rules="required|min_length[2]" class="form-control validate" id="prenom" name="prenom" value="<?= $etudiant[0]->getPrenom() ?>">
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_error('nom'); ?>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Nom &emsp;</b>
                                </span>
                                <label class="sr-only" for="nom">Nom : </label>
                                <input type="text" data-rules="required|min_length[2]" id="nom" class="form-control validate" name="nom" value="<?= $etudiant[0]->getNom() ?>">
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_error('groupe'); ?>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Groupe</b>
                                </span>
                                <label class="sr-only" for="groupe">Groupe :</label>
                                <select data-rules="required" class="form-control validate" name="groupe" id="groupe">
                                    <option value="none">Choisir un groupe</option>
                                    <?php foreach ($groupes as $groupe) : ?>
                                        <option value="<?= $groupe->getIdGroupe() ?>"
                                            <?php if ($groupe->getLibelle() == $etudiant[0]->getGroupe()) :
                                                echo ' selected';
                                            endif; ?>
                                            >
                                            <?= $groupe->getLibelle() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input group">
                                <input type="submit" class="btn btn-default" value="Modifier">
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>