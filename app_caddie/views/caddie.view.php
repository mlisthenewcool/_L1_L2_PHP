<?php
$title="Ajout d'un article";
if (isset($_SESSION['panier'])) {
    $caddie = $_SESSION['panier'];
}
require_once ('partials/header.php'); ?>

    <div class="main-content">
        <div class="container">
            <?php require_once ('partials/flash.php'); ?>
            <?php require_once ('partials/errors.php'); ?>
        </div>

        <div class="container">
            <?php if (isset($caddie)) : ?>
            <h1 class="text-center">Voici vos articles commandés :</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="text-center">Quantité</td>
                    <td class="text-center">Référence</td>
                    <td class="text-center">Désignation</td>
                    <td class="text-center">Prix unitaire</td>
                    <td class="text-center">Prix total</td>
                </tr>
                </thead>

                <tbody>
                    <?php $caddie->afficher() ?>
                </tbody>
            </table>
                <p>Prix total du panier : <?= $caddie->total() ?> </p>
                <!-- <a href="viderCaddie.php">Vider panier</a> -->
                <?php else : set_flash('Panier vide', 'warning'); ?>
                    <p>Panier vide</p>
            <?php endif; ?>
        </div>
    </div>

<?php require_once ('partials/footer.php');