<?php
if (empty($_SESSION['id_prof']))
    header('Location: https://infodb.iutmetz.univ-lorraine.fr/~debernar2u/tutore/index.php');

require_once('views/pages/prof/accueil.html');