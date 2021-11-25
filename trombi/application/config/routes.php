<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Routes pour la connexion
 */
$route['login/ok'] = 'login/etudiant';
$route['login/2'] = 'login/admin';
$route['login/3'] = 'login/professeur';
$route['login/(:any)'] = 'accueil/view/$1';

/*
 * Routes pour la déconnexion
 */
$route['logout/1'] = 'logout/etudiant';
$route['logout/2'] = 'logout/admin';
$route['logout/3'] = 'logout/professeur';
$route['logout/(:any)'] = 'accueil/view/$1';

/*
 * Routes pour la partie étudiant
 */
$route['etudiant/1'] = 'etudiant/upload_image';
$route['etudiant/1/(:any)'] = 'accueil/view/$1';

$route['etudiant'] = 'etudiant/index';
$route['etudiant/(:any)'] = 'accueil/view/$1';

/*
 * Routes pour la partie professeur
 */
$route['prof'] = 'professeur/index';
$route['prof/(:any)'] = 'accueil/view/$1';

/*
 * Routes pour la partie administrateur
 */

/* Partie groupes */
$route['groupes/1'] = 'groupes/create';
$route['groupes/1/(:any)'] = 'accueil/view/$1';

$route['groupes/2'] = 'groupes/update';
$route['groupes/2/(:any)'] = 'accueil/view/$1';

$route['groupes/3'] = 'groupes/delete';
$route['groupes/3/(:any)'] = 'accueil/view/$1';

$route['groupes/4'] = 'groupes/create_etudiant';
$route['groupes/4/(:any)'] = 'accueil/view/$1';

$route['groupes/5'] = 'groupes/delete_etudiant';
$route['groupes/5/(:any)'] = 'accueil/view/$1';

$route['groupes'] = 'groupes/index';
$route['groupes/(:any)'] = 'accueil/view/$1';

/* Partie etudiants */
$route['etudiants/1'] = 'etudiants/create';
$route['etudiants/1/(:any)'] = 'accueil/view/$1';

$route['etudiants/2'] = 'etudiants/update';
$route['etudiants/2/(:any)'] = 'accueil/view/$1';

$route['etudiants/3'] = 'etudiants/delete';
$route['etudiants/3/(:any)'] = 'accueil/view/$1';

$route['etudiants/4'] = 'etudiants/rechercher';
$route['etudiants/4/(:any)'] = 'accueil/view/$1';

$route['etudiants'] = 'etudiants/index';
$route['etudiants/(:any)'] = 'accueil/view/$1';

/* Partie PDF */
$route['pdf/1'] = 'pdf/export_trombi';
$route['pdf/1/(:any)'] = 'accueil/view/$1';

$route['pdf/2'] = 'pdf/export_authentification';
$route['pdf/2/(:any)'] = 'accueil/view/$1';

$route['pdf'] = 'pdf/index';
$route['pdf/(:any)'] = 'accueil/view/$1';

/* Partie CSV */
$route['csv/1'] = 'csv/import';
$route['csv/1/(:any)'] = 'accueil/view/$1';

$route['csv'] = 'csv/index';
$route['csv/(:any)'] = 'accueil/view/$1';

/* Partie accueil admin */
$route['admin'] = 'admin/index';
$route['admin/(:any)'] = 'accueil/view/$1';

/*
 * Routes par défaut
 */
$route['(:any)'] = 'accueil/view/$1';
$route['default_controller'] = 'accueil/view';

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/