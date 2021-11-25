<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"> App IUT </a>
    </div>
    <div id="navbar" class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav">
            <li class="<?= set_active('editSite') ?>"><a href="editSite.php">Gérer les sites de vente</a></li>
            <li class="<?= set_active('venteSite') ?>"><a href="venteSite.php">Gérer les ventes d'un site</a></li>
        </ul>
    </div>
</div>