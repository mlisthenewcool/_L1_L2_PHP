<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiants extends Admin {

    private $etudiants = array();
    private $groupes = array();

    public function __construct() {
        parent::__construct();

        // On charge les modèles, librairies et helpers
        // nécessaires à l'administration des étudiants
        $this->load->model(array('etudiant_model', 'groupe_model'));
        $this->load->library(array('etudiant_class', 'groupe_class', 'form_validation'));
        $this->load->helper(array('form'));

        // On initialise les étudiants et les groupes
        $this->setEtudiants($this->etudiant_model->get_all());
        $this->setGroupes($this->groupe_model->get_all());
    }

    public function index() {
        $data ['title'] = 'Etudiants';

        // Fonction de recherche
        if ( ! empty ($_GET['recherche'])) {
            // Si la recherche a des résultats
            if ($this->etudiant_model->rechercher($this->input->get('recherche')) != null)
                $this->setEtudiants($this->etudiant_model->rechercher($this->input->get('recherche')));
            // Si la recherche n'a aucun résultat
            else {
                $this->session->set_flashdata('info', 'Aucun étudiant ne correspond à la recherche');
                redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
            }
        }

        // On charge les groupes et les étudiants
        $data['etudiants'] = $this->getEtudiants();
        $data['groupes'] = $this->getGroupes();

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/etudiants_view');
        $this->load->view('partials/footer');
    }

    public function create() {
        $data['groupes'] = $this->getGroupes();
        $data['etudiants'] = $this->getEtudiants();

        //On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/admin/etudiants_view');
            $this->load->view('partials/footer');
        }
        // Le formulaire a été envoyé
        else {
            // Test des saisies de l'utilisateur
            // TODO catch exceptions
            $etudiant_create = new Etudiant_class();
            $etudiant_create->setPrenom($this->input->post('prenom'));
            $etudiant_create->setNom($this->input->post('nom'));
            $etudiant_create->setIdGroupe($this->input->post('groupe'));

            // Impossible de créer l'étudiant en base de données
            if ($this->etudiant_model->create($etudiant_create) === FALSE)
                $this->session->set_flashdata('warning', "Erreur lors de la création de l'étudiant " . $etudiant_create->getPrenom() . ' ' . $etudiant_create->getNom());

            // L'étudiant a été créé, on affichage un message de succès
            // et redirection vers la page de gestion des étudiants
            else
                $this->session->set_flashdata('success', "L'étudiant " . $etudiant_create->getPrenom() . ' ' . $etudiant_create->getNom() . ' a été ajouté');

            // Redirection vers l'accueil des étudiants
            redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
        }
    }

    public function update() {
        $data['groupes'] = $this->getGroupes();

        // L'étudiant à mettre à jour
        $data['etudiant'] = null;

        // Chargement des ids pour la gestion d'erreurs du $_GET
        $ids = array();
        foreach ($this->etudiant_model->get_all() as $etudiants) {
            $ids [] = $etudiants->id_etudiant;
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement sans $_GET
        if (empty ($_GET['id'])) {
            $this->session->set_flashdata('error', 'Veuillez choisir un étudiant à modifier');

            // Redirection vers l'accueil des étudiants
            redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement avec un $_GET qui ne correspond
        // à aucun étudiant
        else if ( ! in_array($_GET['id'], $ids)) {
            $this->session->set_flashdata('error', 'Aucun étudiant ne correspond à cet identifiant');

            // Redirection vers l'accueil des étudiants
            redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
        }

        // Le $_GET est valide
        else {
            $data['etudiant'] = $this->etudiant_model->get_by_id($_GET['id']);

            // On affiche le formulaire tant qu'il n'a pas été envoyé
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('partials/header', $data);
                $this->load->view('pages/admin/edit_etudiant_view');
                $this->load->view('partials/footer');
            }

            // Le formulaire a été soumis
            else {
                // On modifie l'étudiant
                $data['etudiant'][0]->setPrenom($this->input->post('prenom'));
                $data['etudiant'][0]->setNom($this->input->post('nom'));
                $data['etudiant'][0]->setIdGroupe($this->input->post('groupe'));

                // echo $this->etudiant_model->update($data['etudiant'][0]);

                // Si la mise a jour échoue on signifie l'erreur et on recharge le formulaire
                if ($this->etudiant_model->update($data['etudiant'][0]) === -1)
                    $this->session->set_flashdata('warning', "Impossible de mettre à jour l'étudiant " . $data['etudiant'][0]->getPrenom() . ' ' . $data['etudiant'][0]->getNom());

                // L'étudiant a été mis à jour, on affiche un message de succès
                else
                    $this->session->set_flashdata('success', "L'étudiant a été mis à jour");

                redirect(base_url(ETUDIANTS_PATH_I . '2?id=' . $data['etudiant'][0]->getIdEtudiant()), 'refresh');
            }
        }
    }

    public function delete() {
        // On enregistre les identifiants des étudiants
        $ids = array();
        foreach ($this->etudiant_model->get_all() as $etudiants) {
            $ids [] = $etudiants->getIdEtudiant();
        }

        $data['etudiant'] = null;

        // L'utilisateur a essayé de soumettre une URL
        // directement sans $_GET
        if (empty ($_GET['id'])) {
            $this->session->set_flashdata('error', 'Veuillez choisir un étudiant');
        }

        // L'utilisateur a essayé de soumettre une URL directement
        // avec un $_GET ne correspondant à aucun groupe
        else if ( ! in_array($_GET['id'], $ids))
            $this->session->set_flashdata('error', 'Aucun étudiant ne correspond à cet identifiant');

        // L'étudiant existe, on le supprime
        else {
            $data['etudiant'] = $this->etudiant_model->get_by_id($_GET['id']);

            // Erreur base de données
            if ( ! $this->etudiant_model->delete($data['etudiant'][0]->getIdEtudiant()))
                $this->session->set_flashdata('warning', "Impossible de supprimer l'étudiant " . $data['etudiant'][0]->getPrenom() . ' ' . $data['etudiant'][0]->getNom());

            // L'étudiant a été supprimé
            else
                $this->session->set_flashdata('success', "L'étudiant " . $data['etudiant'][0]->getPrenom() . ' ' . $data['etudiant'][0]->getNom() . " a été supprimé");
        }

        // Redirection vers l'accueil des étudiants
        redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getEtudiants() {
        return $this->etudiants;
    }

    public function setEtudiants($etudiants) {
        $this->etudiants = $etudiants;
    }
    /**
     * * * * * * * * * * * * * * * * * * * * * *
     */
    public function getGroupes() {
        return $this->groupes;
    }

    public function setGroupes($groupes) {
        $this->groupes = $groupes;
    }
}