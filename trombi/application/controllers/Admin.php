<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Pour une question de performance :
        // On ne charge ici que les librairies et helpers nécessaires
        // dans TOUTES les méthodes dépendant du contrôleur admin
        $this->load->library('session');
        $this->load->helper(array('url', 'html'));

        // Si l'admin n'est pas connecté
        // --> redirection accueil + message d'info
        if ( ! $this->session->has_userdata('id_admin')) {
            $this->session->set_flashdata('info', 'Vous devez vous connecter pour accéder à cette page');
            redirect (base_url('index.php'), 'refresh');
        }
    }

    public function index() {
        $data['title'] = 'Accès admin';

        // On charge les vues
        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/index_view');
        $this->load->view('partials/footer');
    }

    /**
     * @param $select
     * @return bool
     */
    public function is_select_valid ($select) {
        if ($select === "none") {
            $this->form_validation->set_message($select, 'Veuillez choisir un groupe.');
            return false;
        }
        else
            return true;
    }
}