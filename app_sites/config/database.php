<?php
define ('DB_HOST','localhost');
define ('DB_NAME','php_tp4');
define ('DB_USERNAME','root');
define ('DB_PASSWORD','');

try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USERNAME, DB_PASSWORD);
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Silencieux = PDO::ERRMODE_SILENT
    // Précise l'erreur mais continue = PDO::ERRMODE_WARNING
    // Précise l'erreur et s'arrête = PDO::ERRMODE_EXCEPTION
} catch (PDOException $e) {
    die ('Erreur SQL : '.$e->getMessage());
}