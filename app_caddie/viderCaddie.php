<?php
require_once('lib/Caddie.class.php');
require_once('lib/Article.class.php');
session_start();
session_destroy();
require_once ('includes/functions.php');
//$_SESSION['panier'] = array();
//set_flash('Le caddie a bien été vidé');
redirect('commander.php');

require_once('views/caddie.view.php');