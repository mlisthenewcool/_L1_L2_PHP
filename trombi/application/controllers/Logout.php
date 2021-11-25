<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // On charge les librairies et helpers utilisées dans toutes les méthodes
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function etudiant() {
        if ($this->session->has_userdata('id_etudiant')) {
            $this->session->unset_userdata('id_etudiant');
            $this->session->set_flashdata('info', 'A bientôt');
        }

        redirect(base_url('index.php'), 'refresh');
    }

    public function admin() {
        if ($this->session->has_userdata('id_admin')) {
            $this->session->unset_userdata('id_admin');
            $this->session->set_flashdata('info', 'A bientôt');
        }

        redirect(base_url('index.php'), 'refresh');
    }

    public function professeur() {
        if ($this->session->has_userdata('id_prof')) {
            $this->session->unset_userdata('id_prof');
            $this->session->set_flashdata('info', 'A bientôt');
        }

        redirect(base_url('index.php'), 'refresh');
    }
}