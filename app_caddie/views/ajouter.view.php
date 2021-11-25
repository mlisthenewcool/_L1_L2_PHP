<?php
$title="Ajout d'un article";
require_once ('partials/header.php');
?>

    <div class="main-content">
        <div class="container">
            <?php require_once ('partials/flash.php'); ?>
            <?php require_once ('partials/errors.php'); ?>
        </div>

        <div class="container">
            <h1 class="text-center">Articles en vente</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="text-center">Référence</td>
                    <td class="text-center">Désignation</td>
                    <td class="text-center">Prix unitaire</td>
                </tr>
                </thead>

                <tbody>

                <?php
                // On lit le fichier puis on stocke son contenu dans la variable $articles
                $articles = getDataInFile('data/articles.txt');
                if (filesize('data/articles.txt') != false) :
                    foreach ($articles as $article) : ?>
                        <tr>
                            <?php $article->afficher(); ?>
                        </tr>
                    <?php endforeach;
                endif; ?>

                </tbody>
            </table>
        </div>

        <div class="container col-sm-6 col-sm-offset-3">
            <h1 class="text-center">Ajouter un article</h1>
            <form method="post" action="" class="" autocomplete="off">
                <div class="form-group col-sm-5">
                    <input class="form-control" type="text" name="designation" value="<?=get_input('designation')?>" placeholder="Désignation">
                </div>
                <div class="form-group col-sm-5">
                    <input class="form-control" type="text" name="prix" value="<?=get_input('prix')?>" placeholder="Prix unitaire">
                </div>
                <div class="form-group col-sm-1">
                    <input type="submit" class="btn btn-default" name="ajouter" value="Ajouter">
                </div>
            </form>
        </div>
    </div>

<?php require_once ('partials/footer.php');