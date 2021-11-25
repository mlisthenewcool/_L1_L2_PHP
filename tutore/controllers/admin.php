<?php
if (empty($_SESSION['id_admin']))
    header('Location: https://infodb.iutmetz.univ-lorraine.fr/~debernar2u/tutore/index.php');

require_once('views/pages/admin/accueil.html');