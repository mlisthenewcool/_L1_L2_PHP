<?php
// Contrôler les saisies de l'utilisateur
if (!function_exists('e')) {
    function e($string) {
        if($string) {
            return htmlspecialchars($string);
        }
    }
}

// Vérifier si tous les champs du formulaire ont été remplis
if (!function_exists('not_empty')) {
    function not_empty($fields = []) {
        if(count($fields) != 0) {
            foreach($fields as $field) {
                if (empty ($_POST[$field]) || trim ($_POST[$field]) == '') {
                    return false;
                }
            }
            return true;
        }
    }
}

// Redirige l'utilisateur sur la page voulue
if (!function_exists('redirect')) {
    function redirect($page) {
        header('Location: ' .$page);
        exit();
    }
}
// Affiche des messages d'info
if(!function_exists('set_flash')) {
    function set_flash($message, $type = 'info') {
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }
}
// Gère l'état actif des différents liens
if(!function_exists('set_active')) {
    function set_active($file, $class = 'active') {
        $page = array_pop(explode('/', $_SERVER['SCRIPT_NAME']));
        return $page == $file . '.php' ? $class : '';
    }
}
// Récupère les données d'un fichier sérializé
if(!function_exists('getDataInFile')) {
    function getDataInFile($file) {
        return unserialize(file_get_contents($file));
    }
}
// Sauvegarde les saisies si le formulaire contient des erreurs
if(!function_exists('save_input_data')) {
    function save_input_data() {
        foreach($_POST as $key => $value) {
            $_SESSION['input'][$key] = $value;
        }
    }
}
// Récupère la saisie
if(!function_exists('get_input')) {
    function get_input($key) {
        return !empty($_SESSION['input'][$key]) ? htmlspecialchars($_SESSION['input'][$key]) : null;
    }
}
// Efface les champs
if(!function_exists('clear_input_data')) {
    function clear_input_data() {
        if(isset($_SESSION['input'])) {
            $_SESSION['input'] = array();
        }
    }
}