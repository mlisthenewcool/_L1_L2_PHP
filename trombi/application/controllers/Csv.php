<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSV extends Admin {

    private $groupes = array();

    private $etudiants_csv = array();
    private $groupes_csv = array();

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form'));
        $this->load->model(array('groupe_model', 'etudiant_model'));

        // On charge les groupes depuis la base de données
        $this->setGroupes($this->groupe_model->get_all());

        // On charge les étudiants pour les groupes
        foreach ($this->getGroupes() as $groupe)
            $groupe->setEtudiants($this->etudiant_model->get_all_by_groupe($groupe->getIdGroupe()));
    }

    public function index() {
        $data['title'] = 'CSV';

        $data['groupes'] = $this->getGroupes();

        // Le formulaire a été envoyé
        if ( ! empty ($_POST['importer']))
            $this->import();

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/csv_view');
        $this->load->view('partials/footer');
    }

    public function import() {
        $this->load->library(array('Csv_reader_class', 'Etudiant_class'));
        $this->load->model('admin_model');

        $config['upload_path'] = IMAGE_PATH;
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'temp.csv';

        $this->load->library('upload', $config);


        // Impossible de charger le fichier
        if ( ! $this->upload->do_upload('file'))
            $this->session->set_flashdata('error', $this->upload->display_errors());

        // Le fichier a été chargé
        else {
            $csv = $this->csv_reader_class->parse_file(base_url($config['upload_path'] . $config['file_name']));

            // foreach ($_POST as $key => $value)
            // echo 'clé ' . $key . ' valeur ' . $value;

            // Option delete_all
            if (!empty ($_POST['options']) && $_POST['options'] === 'delete_all') {
                $this->admin_model->truncate();
                $this->setGroupes($this->groupe_model->get_all());
            }

            // On traite tous les étudiants
            foreach ($csv as $item) {
                // Création du nouvel étudiant
                $etudiant = new Etudiant_class();
                $etudiant->setPrenom($item['prenom']);
                $etudiant->setNom($item['nom']);
                $etudiant->setGroupe($item['groupe']);

                // Ajout de l'étudiant à la liste d'étudiants à gérer
                $this->etudiants_csv [] = $etudiant;
            }

            // On enregistre les libellés des groupes déjà existants en base de données
            $libelles = array();
            foreach ($this->getGroupes() as $groupe)
                $libelles [] = $groupe->getLibelle();

            // L'array que l'on va utiliser pour empêcher
            // les doublons lors de la récupération
            // des groupes importés en csv
            $libelles_csv = array();

            foreach ($this->getEtudiantsCSV() as $etudiant) {
                /*
                // Option delete_exists
                if ( ! empty ($_POST['options']) && $_POST['options'] === 'delete_exists') {
                    // Si le groupe est dans la base de données
                    if (in_array($etudiant->getGroupe(), $libelles)) {
                        $groupe_exists = $this->groupe_model->get_by_libelle($etudiant->getGroupe());
                        $this->groupe_model->delete($groupe_exists[0]->getIdGroupe());
                    }

                    $this->setGroupes($this->groupe_model->get_all());
                }
                */

                // Si le groupe n'est ni dans la base de données ni dans les groupes csv
                if ( ! in_array($etudiant->getGroupe(), $libelles) &&
                    ! in_array($etudiant->getGroupe(), $libelles_csv) ) {

                    $groupe = new Groupe_class();
                    $groupe->setLibelle($etudiant->getGroupe());

                    // Ajout du libellé à l'array
                    $libelles_csv [] = $groupe->getLibelle();

                    // Ajout du groupe à la liste des groupes csv
                    $this->groupes_csv [] = $groupe;
                }
            }

            // Insertion en base de données
            $this->admin_model->import_csv($this->getGroupesCSV(), $this->getEtudiantsCSV());

            // Envoi des données à la vue
            $data['csv_data'] = $csv;

            // On supprime le fichier temporaire
            if ( file_exists($config['upload_path'] . $config['file_name']))
                unlink($config['upload_path'] . $config['file_name']);

            // Message de succès + Redirection vers l'accueil CSV
            $this->session->set_flashdata('success', "Le traitement a été effectué avec succès");
            redirect(base_url(CSV_PATH_I), 'refresh');
        }

        /*
        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/csv_import_view');
        $this->load->view('partials/footer');
        */
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
    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getEtudiantsCSV() {
        return $this->etudiants_csv;
    }

    public function setEtudiantsCSV($etudiants) {
        $this->etudiants_csv = $etudiants;
    }
    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getGroupesCSV() {
        return $this->groupes_csv;
    }

    public function setGroupesCSV($groupes) {
        $this->groupes_csv = $groupes;
    }
}

