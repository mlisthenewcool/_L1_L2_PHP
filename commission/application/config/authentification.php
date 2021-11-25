<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Table
 *
 * La table utilisée pour enregistrer l'authentification en base de données
 * Elle devra contenir les champs listés ci-dessous
 */
$config['auth']['table'] = 'authentification';
/**
 * Primary key
 *
 * La clé primaire utilisée dans la table
 */
$config['auth']['primary_key'] = 'auth_id';
/**
 * Login
 *
 * Le champ login utilisé dans la table
 */
$config['auth']['login'] = 'login';
/**
 * Password
 *
 * Le champ password utilisé dans la table
 */
$config['auth']['password'] = 'password';
/**
 * Group
 *
 * Le champ type utilisé dans la table
 * @warning
 */
$config['auth']['group'] = 'group';