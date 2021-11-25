<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professeur extends CI_Controller {
    private $groupes = array();

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(array('url', 'html'));
        $this->load->model(array('groupe_model', 'etudiant_model', 'professeur_model'));

        // Si le professeur n'est pas connecté
        // --> redirection accueil + message d'info
        if ( ! $this->session->has_userdata('id_prof')) {
            $this->session->set_flashdata('info', 'Vous devez vous connecter pour accéder à cette page');
            redirect(base_url('index.php'), 'refresh');
        }

        // On charge les groupes depuis la base de données
        $this->setGroupes($this->groupe_model->get_all());

        // On charge les étudiants pour les groupes
        foreach ($this->getGroupes() as $groupe)
            $groupe->setEtudiants($this->etudiant_model->get_all_by_groupe($groupe->getIdGroupe()));
    }

    public function index() {
        $data['title'] = 'Accès professeur';

        $data['groupes'] = $this->getGroupes();

        $this->load->view('partials/header', $data);
        $this->load->view('pages/prof/index_view');
        $this->load->view('partials/footer');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getGroupes() {
        return $this->groupes;
    }

    public function setGroupes($groupes) {
        $this->groupes = $groupes;
    }
}