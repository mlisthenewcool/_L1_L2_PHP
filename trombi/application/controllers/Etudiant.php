<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends CI_Controller {

    private $etudiant = array();

    public function __construct() {
        parent::__construct();

        $this->load->model('etudiant_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form', 'html'));

        // Si l'étudiant n'est pas connecté
        // --> redirection accueil + message d'info
        if ( ! $this->session->has_userdata('id_etudiant')) {
            $this->session->set_flashdata('info', 'Vous devez vous connecter pour accéder à cette page');
            redirect(base_url('index.php'), 'refresh');
        }

        // Initialisation de l'étudiant
        $this->setEtudiant($this->etudiant_model->get_by_id($this->session->userdata('id_etudiant')));
    }

    public function index() {
        $data['title'] = 'Accès étudiant';

        // On charge les infos de l'étudiant pour la page
        $data['etudiant'] = $this->getEtudiant();

        /*
        // Resize image
        $config_resize['image_library'] = 'gd2';
        $config_resize['source_image'] = IMAGE_PATH . $this->getEtudiant()[0]->getPhoto();
        $config_resize['maintain_ratio'] = TRUE;
        $config_resize['quality'] = "100%";
        $config_resize['width'] = 250;
        $config_resize['height'] = 200;

        $this->load->library('image_lib', $config_resize);

        if ( ! $this->image_lib->resize()) {
            $this->session->set_flashdata('error', $this->image_lib->display_errors());
            redirect(ETUDIANT_PATH, 'refresh');
        }

        else
            $data['photo'] = $config_resize['source_image'];
        */

        // Sinon on charge les vues
        $this->load->view('partials/header', $data);
        $this->load->view('pages/etudiant/index_view');
        $this->load->view('partials/footer');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * *
     * Contrôle le chargement d'une image de profil
     * Enregistre le nom de l'image dans la bdd
     * Déplace l'image dans le dossier images/
     * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function upload_image() {
        $path = $_FILES['image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $config['upload_path'] = IMAGE_PATH;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['overwrite'] = TRUE;
        $config['file_name'] = $this->session->userdata('id_etudiant') . '.' . $ext ;

        $this->load->library('upload', $config);

        /*
        $zdata = array('upload_data' => $this->upload->data()); // get data
        $zfile = $zdata['upload_data']['full_path']; // get file path
        $this->chmod($zfile, 0777); // CHMOD file
        */

        // Si l'image a été chargée, on l'enregistre en base de données sous la forme id_etudiant.ext
        if ($this->upload->do_upload('image')) {

            // Resize image
            $config_resize['image_library'] = 'gd2';
            $config_resize['source_image'] = IMAGE_PATH . $config['file_name'];
            $config_resize['maintain_ratio'] = TRUE;
            $config_resize['quality'] = "100%";
            $config_resize['width'] = 150;
            $config_resize['height'] = 85;

            $this->load->library('image_lib', $config_resize);

            if ( ! $this->image_lib->resize()) {
                $this->session->set_flashdata('error', $this->image_lib->display_errors());
                redirect(ETUDIANT_PATH, 'refresh');
            }

            $this->etudiant_model->upload_image($config['file_name'], $this->session->userdata('id_etudiant'));
            $this->session->set_flashdata('success', "L'image a été mise à jour");
            redirect(ETUDIANT_PATH, 'refresh');
        }
        // Sinon on affiche une erreur
        else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect(ETUDIANT_PATH, 'refresh');
        }
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getEtudiant() {
        return $this->etudiant;
    }

    public function setEtudiant($etudiant) {
        $this->etudiant = $etudiant;
    }
}