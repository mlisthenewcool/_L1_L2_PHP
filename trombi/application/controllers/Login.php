<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // On charge les librairies et helpers utilisés dans toutes les méthodes
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html'));

        //Si l'étudiant est déjà connecté, on le redirige vers son accueil
        if ($this->session->has_userdata('id_etudiant'))
            redirect (base_url(ETUDIANT_PATH_I), 'refresh');
        // Si l'admin est déjà connecté, on le redirige vers son accueil
        else if ($this->session->has_userdata('id_admin'))
            redirect (base_url(ADMIN_PATH_I), 'refresh');
        // Si le professeur est déjà connecté, on le redirige vers son accueil
        else if ($this->session->has_userdata('id_prof'))
            redirect (base_url(PROF_PATH_I), 'refresh');
    }

    public function etudiant() {
        $data['title'] = 'Connexion';

        // On charge l'accès au modèle (base de données) étudiant
        $this->load->model('etudiant_model');

        // On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() === false) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/login/etudiant_view');
            $this->load->view('partials/footer');
        }
        // Le formulaire a été envoyé
        else {
            $id_etudiant = $this->etudiant_model->login($this->input->post('login'), $this->input->post('password'));

            // La connexion a échoué, on signale l'erreur et on affiche à nouveau le formulaire
            if ($id_etudiant === -1) {
                $this->session->set_flashdata('error', "Erreur d'authenfication");
                $this->load->view('partials/header');
                $this->load->view('pages/login/etudiant_view', $data);
                $this->load->view('partials/footer');
            }

            // L'étudiant a été identifié, on le connecte et le redirige vers sa page d'accueil
            else {
                $this->session->set_userdata('id_etudiant', $id_etudiant);
                $this->session->set_flashdata('info', "Content de te revoir poto");
                redirect(base_url(ETUDIANT_PATH_I), 'refresh');
            }
        }
    }

    public function admin() {
        $data['title'] = 'Connexion';

        // On charge l'accès au modèle (base de données) administrateur
        $this->load->model('admin_model');

        // On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/login/admin_view');
            $this->load->view('partials/footer');
        }
        // Le formulaire a été envoyé
        else {
            $id_admin = $this->admin_model->login($this->input->post('login'), $this->input->post('password'));

            // La connexion a échoué, on signifie l'erreur et on recharge le formulaire
            if ($id_admin === -1) {
                $this->session->set_flashdata('error', "Erreur d'authenfication");
                $this->load->view('partials/header', $data);
                $this->load->view('pages/login/admin_view', $data);
                $this->load->view('partials/footer', $data);
            }
            // L'admin a été identifié, on le connecte et le redirige vers sa page d'accueil
            else {
                $this->session->set_userdata('id_admin', $id_admin);
                $this->session->set_flashdata('info', 'Content de vous revoir patron');
                redirect(base_url(ADMIN_PATH_I), 'refresh');
            }
        }
    }

    public function professeur() {
        $data['title'] = 'Connexion';

        // On charge l'accès au modèle (base de données) professeur
        $this->load->model('professeur_model');

        // On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/login/prof_view');
            $this->load->view('partials/footer');
        }
        // Le formulaire a été envoyé
        else {
            $id_prof = $this->professeur_model->login($this->input->post('login'), $this->input->post('password'));

            // La connexion a échoué, on signifie l'erreur et on recharge le formulaire
            if ($id_prof === -1) {
                $this->session->set_flashdata('error', "Erreur d'authenfication");
                $this->load->view('partials/header', $data);
                $this->load->view('pages/login/prof_view', $data);
                $this->load->view('partials/footer', $data);
            }
            // Le professeur a été identifié, on le connecte et le redirige vers sa page d'accueil
            else {
                $this->session->set_userdata('id_prof', $id_prof);
                $this->session->set_flashdata('info', 'Content de vous revoir');
                redirect(base_url(PROF_PATH_I), 'refresh');
            }
        }
    }
}