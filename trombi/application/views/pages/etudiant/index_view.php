<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if (isset($etudiant[0])) : ?>
    <div class="container col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
        <div class="row">
            <div class="thumbnail">
                <img src="<?= base_url('images/' . $etudiant[0]->getPhoto()) ?>" class="img-responsive" alt=""/>
                <div class="caption">
                    <h6 class="text-center"><?= $etudiant[0]->getPrenom() ?></h6>
                    <h6 class="text-center"><?= $etudiant[0]->getNom() ?></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="container col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
        <?php echo form_open_multipart(ETUDIANT_PATH . '1'); ?>
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <input type="file" name="image" size="20">
        </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <input type="submit" class="btn btn-default col-lg-6 col-md-6 col-sm-6 col-xs-6" value="Valider">
        </div>
        <?php echo form_close(); ?>
    </div>
<?php endif;