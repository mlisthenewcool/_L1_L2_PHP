<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper(array('url', 'html'));

		/* Utilisateur pas connecté */
		if (( ! $this->session->has_userdata('id_prof')) && ( ! $this->session->has_userdata('id_admin')))
			redirect(base_url('/accueil'), 'refresh');
	}

	public function prof() {
		if ($this->session->has_userdata('id_prof'))
			$this->session->unset_userdata('id_prof');

		// echo json_encode(array('message' => 'A bientôt'));
		redirect(base_url('/accueil'), 'refresh');
	}

	public function admin() {
		if ($this->session->has_userdata('id_admin'))
			$this->session->unset_userdata('id_admin');

		// echo json_encode(array('message' => 'A bientôt'));
		redirect(base_url('/accueil'), 'refresh');
	}
}