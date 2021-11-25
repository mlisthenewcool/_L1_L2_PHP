<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
  'login_professeur' => array(
    array(
      'field' => 'login_prof',
      'label' => 'Identifiant',
      'rules' => 'trim|required|min_length[4]'
    ),

    array(
      'field' => 'password_prof',
      'label' => 'Mot de passe',
      'rules' => 'trim|required|min_length[4]'
    )
  ),

  'login_admin' => array(
    array(
      'field' => 'login_admin',
      'label' => 'Identifiant',
      'rules' => 'trim|required|min_length[4]'
    ),

    array(
      'field' => 'password_admin',
      'label' => 'Mot de passe',
      'rules' => 'trim|required|min_length[4]'
    )
  ),

	'add_etudiant_commission' => array(
    array(
      'field' => 'description',
      'label' => 'Description',
      'rules' => 'trim|required|min_length[30]'
    ),

		array(
      'field' => 'decisions[]',
      'label' => 'Décisions',
      'rules' => 'trim|required', //'callback__is_checkbox_valid',
			//'errors' => array('_is_checkbox_valid' => 'Veuillez choisir au moins une décision')
		)
	),

	'add_commission' => array(
		array(
			'field' => 'type_vote',
			'label' => 'Type de vote',
			'rules' => 'trim|required'
		),

		array(
			'field' => 'date',
			'label' => 'Date',
			'rules' => 'trim|required', //'callback__is_checkbox_valid',
			//'errors' => array('_is_checkbox_valid' => 'Veuillez choisir au moins une décision')
		)
	)
);