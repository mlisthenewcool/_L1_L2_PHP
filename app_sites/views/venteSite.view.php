<?php
$title="Ventes d'un site";
require_once('views/partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <?php require_once('views/partials/flash.php'); ?>
        <?php require_once('views/partials/errors.php'); ?>
    </div>

    <div class="container col-sm-6">
        <h1 class="text-center">Choisir un site pour éditer ses ventes</h1>
        <form method="get">
            <div class="form-group">
                <select onchange="showSite(this.value)"class="form-group" name="sites">
                    <option value="">Selectionner un site</option>
                    <?php $query = $db->prepare("SELECT * FROM sites");
                    $query->execute();
                    foreach ($query as $site) : ?>
                        <option value="<?=$site["idSite"]?>"><?=$site["nom"] . ' à ' . $site["ville"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <div id="tableSite" class="container col-sm-6">
        <h1 class="text-center">Informations du site</h1>
    </div>
</div>

<?php require_once('views/partials/footer.php');