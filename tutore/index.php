<?php
require_once 'helpers/views.php';

/* On demande une page spécifique */
if ( ! empty ($_GET['p']))
{
    //$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    $request_controller = 'controllers/' . $_GET['p'] . '.php';
    $error_controller = 'controllers/error.php';

    is_file($request_controller) ? require_once $request_controller : require_once $error_controller;
}
/* Page d'accueil */
else
    require_once 'controllers/accueil.php';