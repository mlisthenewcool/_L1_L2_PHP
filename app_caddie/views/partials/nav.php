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
            <li class="<?= set_active('ajouter') ?>"><a href="ajouter.php">Ajouter un article</a></li>
            <li class="<?= set_active('commander') ?>"><a href="commander.php">Commander</a></li>
            <li class="<?= set_active('caddie') ?>"><a href="caddie.php">Voir le contenu du caddie</a></li>
        </ul>
    </div>
</div>