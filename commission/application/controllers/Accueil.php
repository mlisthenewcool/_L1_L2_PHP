<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper(array('url', 'html'));

		/* Utilisateur connecté */
		if ($this->session->has_userdata('id_prof'))
			redirect(base_url('/prof'));
		elseif ($this->session->has_userdata('id_admin'))
			redirect(base_url('/admin'));
	}

	public function index()
	{
		$this->load->view('pages/accueil.html');
	}
}