<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->model('authentification_model');

		/* Utilisateur déjà connecté */
		if ($this->session->has_userdata('id_prof'))
			redirect(base_url('/prof'));
		elseif ($this->session->has_userdata('id_admin'))
			redirect(base_url('/admin'));
	}

	public function admin()
	{
		if( ! $this->input->is_ajax_request())
			redirect(base_url('/accueil'), 'refresh');

		/* Formulaire OK */
		if ($this->form_validation->run('login_admin') === TRUE)
		{
			/* Erreur de connexion */
			if (($id = $this->authentification_model->login($this->input->post('login_admin'), $this->input->post('password_admin'), 'administrateur')) === -1)
				echo json_encode(array('reponse' => "Erreur d'authentification"));

			/* Connexion OK */
			else
			{
				$this->session->set_userdata('id_admin', $id);
				echo json_encode(array('reponse' => 'ok', 'redirect' => base_url('/admin')));
			}
		}
		/* Erreur dans le formulaire */
		else
			echo json_encode(array('reponse' => $this->form_validation->error_string()));
	}

	public function prof()
	{
		if( ! $this->input->is_ajax_request())
			redirect(base_url('/accueil'));

		/* Formulaire OK */
		if ($this->form_validation->run('login_professeur') === TRUE)
		{
			/* Erreur de connexion */
			if (($id = $this->authentification_model->login($this->input->post('login_prof'), $this->input->post('password_prof'), 'professeur')) < 1)
				echo json_encode(array('reponse' => "Erreur d'authentification"));

			/* Connexion OK */
			else
			{
				$this->session->set_userdata('id_prof', $id);
				echo json_encode(array('reponse' => 'ok', 'redirect' => base_url('/prof')));
			}
		}
		/* Erreur dans le formulaire */
		else
			echo json_encode(array('reponse' => $this->form_validation->error_string()));
	}
}