<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Constantes créées pour facilier les imports et les appels aux contrôleurs
|--------------------------------------------------------------------------
*/
defined('CSS_PATH') OR define ('CSS_PATH', 'assets/css/');
defined('JS_PATH') OR define ('JS_PATH', 'assets/js/');
defined('FONT-AWESOME_PATH') OR define ('FONT_AWESOME_PATH', 'assets/font-awesome/');
defined('ICONE_PATH') OR define ('ICONE_PATH', 'assets/icones/');
defined('IMAGE_PATH') OR define ('IMAGE_PATH', 'images/');
defined('BOOTSWATCH_PATH') OR define ('BOOTSWATCH_PATH', 'assets/bootswatch/paper/');

defined('DOC_CODEIGNITER_PATH') OR define ('DOC_CODEIGNITER_PATH', 'user_guide');
defined('DOC_PERSO_PATH') OR define ('DOC_PERSO_PATH', '');

defined('TCPDF_PATH') OR define ('TCPDF_PATH', 'application/libraries/tcpdf/tcpdf.php');

defined('LOGIN_PATH_I') OR define ('LOGIN_PATH_I', 'index.php/login/');
defined('LOGIN_PATH') OR define ('LOGIN_PATH', 'login/');

defined('LOGOUT_PATH_I') OR define ('LOGOUT_PATH_I', 'index.php/logout/');

defined('ETUDIANT_PATH_I') OR define ('ETUDIANT_PATH_I', 'index.php/etudiant/');
defined('ETUDIANT_PATH') OR define ('ETUDIANT_PATH', 'etudiant/');

defined('ADMIN_PATH_I') OR define ('ADMIN_PATH_I', 'index.php/admin/');
defined('ADMIN_PATH') OR define ('ADMIN_PATH', 'admin/');

defined('GROUPES_PATH_I') OR define ('GROUPES_PATH_I', 'index.php/groupes/');
defined('GROUPES_PATH') OR define ('GROUPES_PATH', 'groupes/');

defined('ETUDIANTS_PATH_I') OR define ('ETUDIANTS_PATH_I', 'index.php/etudiants/');
defined('ETUDIANTS_PATH') OR define ('ETUDIANTS_PATH', 'etudiants/');

defined('PDF_PATH_I') OR define ('PDF_PATH_I', 'index.php/pdf/');
defined('PDF_PATH') OR define ('PDF_PATH', 'pdf/');

defined('CSV_PATH_I') OR define ('CSV_PATH_I', 'index.php/csv/');
defined('CSV_PATH') OR define ('CSV_PATH', 'csv/');

defined('PROF_PATH_I') OR define ('PROF_PATH_I', 'index.php/prof/');
defined('PROF_PATH') OR define ('PROF_PATH', 'prof/');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
