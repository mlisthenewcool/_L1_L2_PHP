<?php
$title="Gestion des sites de vente";
require_once('views/partials/header.php');
?>
    <div class="main-content">
        <div class="container">
            <?php require_once('views/partials/flash.php'); ?>
            <?php require_once('views/partials/errors.php'); ?>
        </div>

        <div class="container col-sm-7">
            <h2 class="text-center">Gestion des sites de vente</h2>
            <br /><br />
            <form method="post" action="">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-center">Nom</td>
                        <td class="text-center">Ville</td>
                        <td class="text-center">Latitude</td>
                        <td class="text-center">Longitude</td>
                        <td class="text-center"></td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sites = $db->prepare("SELECT * FROM sites");
                    $sites->execute();
                    foreach ($sites as $site) {
                        echo (
                            '<tr>' .
                                '<td class="text-center">' . $site['nom'] . '</td>' .
                                '<td class="text-center">' . $site['ville'] . '</td>' .
                                '<td class="text-center">' . $site['latitude'] . '</td>' .
                                '<td class="text-center">' . $site['longitude'] . '</td>' .
                                '<td class="text-center"><input type="radio" name="id[]" value="' . $site['idSite'] . '"></td>' .
                            '</tr>'
                        );
                    }
                    ?>
                    </tbody>
                </table>
                <div class="col-sm-2 col-sm-offset-8">
                    <input class="btn btn-default" type="submit" name="modifier" value="Modifier">
                </div>
                <div class="col-sm-2">
                    <input class="btn btn-default" type="submit" name="supprimer" value="Supprimer">
                </div>
            </form>
        </div>

        <div class="container col-sm-3 col-sm-offset-1">
            <h2 class="text-center">Ajouter un site</h2>
            <br /><br />
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" name="nom" value="<?=get_input('nom')?>" placeholder="Nom">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="ville" value="<?=get_input('ville')?>" placeholder="Ville">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="latitude" value="<?=get_input('latitude')?>" placeholder="Latitude">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="longitude" value="<?=get_input('longitude')?>" placeholder="Longitude">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-default" value="Ajouter" name="ajout">
                </div>
            </form>
        </div>
    </div>
<?php require_once('views/partials/footer.php');