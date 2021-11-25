<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professeur extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');

		/* Professeur non connecté */
		if ( ! $this->session->has_userdata('id_prof'))
			redirect (base_url('/accueil'), 'refresh');
	}

	public function index()
	{
		$this->load->view('pages/prof.html');

		/*
		// inclusion des librairies que l'on utilise
		$this->load->library(array('promotion', 'exceptions/ObjectAlreadyExists', 'exceptions/DataAccess'));
		$this->load->model('promotion_model');

		try {
			$promo = new Promotion(); // instantiation d'une classe
			$promo->set_libelle('DUT-Info-Semestre-1'); // peut générer InvalidArgumentException

			$id = $this->promotion_model->create($promo); // peut générer ObjectAlreadyExistsException ou DataAccessException
			echo 'La classe ' . $promo->get_libelle() . ' a été ajoutée';

			$promo->set_libelle('DUT-Info-Semestre-2');
			$promo->set_id($id);

			$this->promotion_model->update($promo);
			echo 'La classe ' . $promo->get_libelle() . ' a été mise à jour';

		} catch (InvalidArgumentException $e) {
			echo $e->getMessage();

		} catch (ObjectAlreadyExists $e) {
			echo $e->getMessage();

		} catch (DataAccess $e) {
			echo $e->getMessage();
		}
		*/
	}

	public function voter()
	{

	}
}