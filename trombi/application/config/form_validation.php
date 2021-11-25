<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'login/etudiant' => array(
        array(
            'field' => 'login',
            'label' => 'Identifiant',
            'rules' => 'trim|required|min_length[4]'
        ),

        array(
            'field' => 'password',
            'label' => 'Mot de passe',
            'rules' => 'trim|required|min_length[6]'
        )
    ),

    'login/admin' => array(
        array(
            'field' => 'login',
            'label' => 'Identifiant',
            'rules' => 'trim|required|min_length[4]'
        ),

        array(
            'field' => 'password',
            'label' => 'Mot de passe',
            'rules' => 'trim|required|min_length[6]'
        )
    ),

    'login/professeur' => array(
        array(
            'field' => 'login',
            'label' => 'Identifiant',
            'rules' => 'trim|required|min_length[4]'
        ),

        array(
            'field' => 'password',
            'label' => 'Mot de passe',
            'rules' => 'trim|required|min_length[6]'
        )
    ),

    'etudiants/index' => array(
        array(
            'field' => 'recherche',
            'label' => 'Recherche',
            'rules' => 'trim|required'
        )
    ),

    'etudiants/create' => array(
        array(
            'field' => 'prenom',
            'label' => 'Prénom',
            'rules' => 'trim|required|min_length[2]'
        ),

        array(
            'field' => 'nom',
            'label' => 'Nom',
            'rules' => 'trim|required|min_length[2]'
        ),

        array(
            'field' => 'groupe',
            'label' => 'Groupe',
            'rules' => 'trim|required|callback_is_select_valid',
            'errors' => array('is_select_valid' => 'Veuillez choisir un groupe.')
        )
    ),

    'etudiants/update' => array(
        array(
            'field' => 'prenom',
            'label' => 'Prénom',
            'rules' => 'trim|required|min_length[2]'
        ),

        array(
            'field' => 'nom',
            'label' => 'Nom',
            'rules' => 'trim|required|min_length[2]'
        ),

        array(
            'field' => 'groupe',
            'label' => 'Groupe',
            'rules' => 'trim|required|callback_is_select_valid',
            'errors' => array('is_select_valid' => 'Veuillez choisir un groupe.')
        )
    ),

    'groupes/index' => array(
        array(
            'field' => 'recherche',
            'label' => 'Recherche',
            'rules' => 'trim|required'
        )
    ),

    'groupes/create' => array(
        array(
            'field' => 'libelle',
            'label' => 'Libellé',
            'rules' => 'trim|required',
        )
    ),

    'groupes/update' => array(
        array(
            'field' => 'libelle',
            'label' => 'Libellé',
            'rules' => 'trim|required',
        )
    ),

    'groupes/create_etudiant' => array(
        array(
            'field' => 'prenom',
            'label' => 'Prénom',
            'rules' => 'trim|required|min_length[2]'
        ),

        array(
            'field' => 'nom',
            'label' => 'Nom',
            'rules' => 'trim|required|min_length[2]'
        )
    ),

    'pdf/index' => array(
        array(
            'field' => '',
            'label' => '',
            'rules' => ''
        )
    )
);

