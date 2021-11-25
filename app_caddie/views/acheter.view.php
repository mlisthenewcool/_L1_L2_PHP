<?php
$title="Ajout d'un article";
require_once ('partials/header.php');
?>

    <div class="main-content">
        <div class="container">
            <?php require_once ('partials/flash.php'); ?>
            <?php require_once ('partials/errors.php'); ?>
        </div>

        <div class="container col-sm-6 col-sm-offset-3">
            <?php
            // On lit le fichier puis on stocke son contenu dans la variable $articles
            $articles = getDataInFile('data/articles.txt');
            foreach ($articles as $article) :
                if ($article->getReference() == $_GET['article']) : ?>
                    <h1 class="text-center">Acheter l'article suivant :</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-center">Référence</td>
                                <td class="text-center">Désignation</td>
                                <td class="text-center">Prix unitaire</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php $article->afficher(); ?>
                            </tr>
                        </tbody>
                    </table>
        </div>

        <div class="container col-sm-6 col-sm-offset-3">
            <form method="post" action="" class="" autocomplete="off">
                <div class="form-group col-sm-4 col-sm-offset-2">
                    <input class="form-control" type="text" name="quantite" placeholder="Quantité désirée">
                </div>
                <div class="form-group col-sm-2">
                    <input type="submit" class="btn btn-default" name="acheter" value="Ajouter au panier">
                </div>
                <div class="form-group col-sm-6 col-sm-offset-3">
                    <a href="commander.php">Annuler et retourner à la liste des articles</a>
                </div>
            </form>
        </div>
    </div>
                <?php endif;
            endforeach; ?>

<?php require_once ('partials/footer.php');