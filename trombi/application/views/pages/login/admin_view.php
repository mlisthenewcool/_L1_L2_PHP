 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>  

<div class="container">
    <div class="form-group col-lg-6 col-md-8 col-sm-10 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-1">
        <?php echo form_open(LOGIN_PATH . '2', array('name' => "login_form",'id' => "login_form")); ?>
            <fieldset>
                <legend class ="text-center">Connexion (accès administrateur)</legend>
                
                <div class="form-group">
                    <?php echo form_error('login'); ?>
                    <label class="sr-only" for="login">Identifiant</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <img src="<?= base_url(ICONE_PATH . 'login.png'); ?>">
                        </span>
                        <input type="text" data-rules="required|min_length[4]" class="form-control validate" name="login" id="login" value="<?= set_value('login'); ?>" placeholder="Identifiant">
                        <p class="help-block"></p>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php echo form_error('password'); ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <img src="<?= base_url(ICONE_PATH . 'password.png'); ?>">
                        </span>
                        <input type="password" data-rules="required|min_length[6]" class="form-control validate" name="password" id="password" placeholder="Mot de passe">
                        <p class="help-block"></p>
                    </div>
                </div>
                
                <div class="form-group text-center col-md-4 col-sm-4 col-xs-6 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
                    <input type="submit" class="btn btn-default" value="Connexion" name ="Submit">
                </div>
                
            </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>