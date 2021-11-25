<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	private $dao;
	private $decisions;
	private $etudiants;

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('promotion', 'personne', 'etudiant', 'commission', 'dao_commission', 'session', 'form_validation'));
		$this->load->helper('url');
		$this->load->model(array('etudiant_model', 'decision_model'));

		/* Admin pas connecté */
		if ( ! $this->session->has_userdata('id_admin'))
			redirect (base_url('/accueil'));

		/* Setup initial */
		$this->set_dao(Dao_Commission::get_instance());

		//$this->session->unset_userdata('dao');

		if($this->session->has_userdata('dao'))
			$this->set_dao($this->session->userdata('dao'));

		$this->set_decisions($this->decision_model->get_all());
		$this->set_etudiants($this->etudiant_model->get_all());
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function index()
	{
		$this->load->view('pages/admin.html');

		//$etu = $this->etudiant_model->get_by_id(5);
		//$this->dao->ajouter_etudiant($etu[0]);
		//$this->get_dao()->ajouter_description_etudiant(5, 'Bonjour');
	}

	/**
	 * * * * * * * * * * * * * *
	 * AJAX FUNCTIONS
	 * * * * * * * * * * * * * *
	 */
	public function decisions()
	{
		if( ! $this->input->is_ajax_request())
			redirect(base_url('/admin'), 'refresh');

		//$display = array();
		foreach($this->get_decisions() as $decision)
		{
			$display[] =
				'<label class="checkbox-inline">' .
				'<input type="checkbox" name="decisions[]" value="' . $decision->get_id() . '"> ' . $decision->get_libelle() .
				'</label>';
		}

		echo json_encode($display);
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function table_etudiants()
	{
		if( ! $this->input->is_ajax_request())
			redirect(base_url('/admin'), 'refresh');

		foreach($this->get_etudiants() as $etudiant)
		{
			$row[] = array(
				'id' => $etudiant->get_id(),
				'prenom' => $etudiant->get_prenom(),
				'nom' => $etudiant->get_nom(),
				//'situation' => $etudiant->get_situation(),
				//'decisions' => $etudiant->get_decisions(),
				'ajouter' => "<a href='javascript:void(0)' class='btn btn-default' onclick='ajouter_etudiant(" . $etudiant->get_id() . ")'>+</button>",
				'supprimer' => "<a href='javascript:void(0)' class='btn btn-default' onclick='supprimer_etudiant(" . $etudiant->get_id() . ")'>-</button>"
			);
		}
		echo json_encode($row);
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function ajouter_etudiant($id)
	{
		if( ! $this->input->is_ajax_request())
			redirect(base_url('/admin'), 'refresh');

		$etudiant = $this->etudiant_model->get_by_id($id);

		if ($this->dao->ajouter_etudiant($etudiant[0]) === FALSE)
			echo json_encode(array('reponse' => 'erreur', 'message' => "L'étudiant a déjà été ajouté à cette commission"));

		else
		{
			$this->session->set_userdata('dao', $this->get_dao());
			echo json_encode(array('message' => "L'étudiant " . $etudiant[0]->get_prenom() . ' ' . $etudiant[0]->get_nom() . ' a été ajouté à la commission'));
			/*
			foreach($this->session->userdata('dao')->get_commission()->get_etudiants() as $etudiant)
			{
				$row[] = array(
					'id' => $etudiant->get_id(),
					'prenom' => $etudiant->get_prenom(),
					'nom' => $etudiant->get_nom(),
					//'situation' => $etudiant->get_situation(),
					//'decisions' => $etudiant->get_decisions(),
					//'ajouter' => "<a href='javascript:void(0)' class='btn btn-default' onclick='ajouter_etudiant(" . $etudiant->get_id() . ")'>+</button>",
					//'supprimer' => "<a href='javascript:void(0)' class='btn btn-default' onclick='supprimer_etudiant(" . $etudiant->get_id() . ")'>-</button>"
				);
			}
			echo json_encode($row);
			*/
		}
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function add_commission()
	{
		//$this->get_dao()->ajouter_description_etudiant(5, 'Bonjour');

		if( ! $this->input->is_ajax_request())
			redirect(base_url('/admin'), 'refresh');

		/* Formulaire OK */
		if ($this->form_validation->run('add_commission') === TRUE)
		{
			// ajouter la commission BDD
			echo json_encode(array('reponse' => 'ok'));
		}

		/* Erreur dans le formulaire */
		else
			echo json_encode(array('reponse' => $this->form_validation->error_string()));
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_dao()
	{
		return $this->dao;
	}

	public function set_dao(Dao_Commission $dao)
	{
		$this->dao = $dao;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_decisions()
	{
		return $this->decisions;
	}

	public function set_decisions($decisions)
	{
		$this->decisions = $decisions;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_etudiants()
	{
		return $this->etudiants;
	}

	public function set_etudiants($etudiants)
	{
		$this->etudiants = $etudiants;
	}
}