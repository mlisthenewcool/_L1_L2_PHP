<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // On charge les librairies et helpers que l'on va utiliser
        $this->load->library('session');
        $this->load->helper(array('url', 'html'));

        // Si l'utilisateur est déjà connecté on le redirige vers son contrôleur
        if ($this->session->has_userdata('id_etudiant'))
            redirect(base_url(ETUDIANT_PATH_I), 'refresh');
        else if ($this->session->has_userdata('id_admin'))
            redirect (base_url(ADMIN_PATH_I), 'refresh');
        else if ($this->session->has_userdata('id_prof'))
            redirect (base_url(PROF_PATH_I), 'refresh');
    }

    public function view($page = 'index_view') {
        //Si la page n'existe pas on affiche une erreur 404
        if ( ! file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        // Sinon on affiche la page
        $data['title'] = ucfirst(str_replace('_view', '', $page));
        $this->load->view('partials/header', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('partials/footer', $data);
    }
}
