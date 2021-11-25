<?php
$title="Commander";
require_once ('partials/header.php'); ?>

    <div class="main-content">
        <div class="container">
            <?php require_once ('partials/flash.php'); ?>
            <?php require_once ('partials/errors.php'); ?>
        </div>

        <div class="container">
            <h1 class="text-center">Ajouter au panier</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="text-center">Référence</td>
                    <td class="text-center">Désignation</td>
                    <td class="text-center">Prix unitaire</td>
                    <td class="text-center">Acheter</td>
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
                            <td class="text-center"><a href= <?= "acheter.php?article=". $article->getReference() ?> >Acheter</a></td>
                        </tr>
                    <?php endforeach;
                endif; ?>

                </tbody>
            </table>
        </div>
    </div>

<?php require_once ('partials/footer.php');