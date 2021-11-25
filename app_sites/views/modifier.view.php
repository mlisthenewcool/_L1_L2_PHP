<?php
$title="Modifier un site";
require_once('views/partials/header.php');
?>

    <div class="main-content">
    <div class="container">
        <?php require_once('views/partials/flash.php'); ?>
        <?php require_once('views/partials/errors.php'); ?>
    </div>

    <div class="container col-sm-4 col-sm-offset-4">
        <h1 class="text-center">Modifier les sites de vente</h1>
        <br /><br />
        <form method="post" action="">
            <?php $sites = $db->prepare("SELECT nom, ville, latitude, longitude FROM sites WHERE idSite=:id");
            $sites->execute(['id' => $_SESSION['id']]);
            foreach ($sites as $site) : ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="nom" value="<?= $site['nom']?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="ville" value="<?= $site['ville']?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="latitude" value="<?= $site['latitude']?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="longitude" value="<?= $site['longitude']?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-default" value="Mettre à jour" name="modifier">
                </div>
                <?php endforeach; ?>
        </form>
    </div>

<?php
require_once('views/partials/footer.php');