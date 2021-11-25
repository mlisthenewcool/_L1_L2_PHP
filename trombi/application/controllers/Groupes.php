<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupes extends Admin {

    private $groupes = array();

    public function __construct() {
        parent::__construct();

        // On charge les modèles, librairie et helpers
        // nécessaires à l'administration des groupes
        $this->load->model('groupe_model');
        $this->load->library(array('groupe_class', 'form_validation'));
        $this->load->helper('form');

        // On charge les groupes depuis la base de données
        $this->setGroupes($this->groupe_model->get_all());
    }

    public function index() {
        $data ['title'] = 'Groupes';

        // Fonction de recherche
        if ( ! empty ($_GET['recherche'])) {
            // Si la recherche a des résultats
            if ($this->groupe_model->rechercher($this->input->get('recherche')) != null)
                $this->setGroupes($this->groupe_model->rechercher($this->input->get('recherche')));
            // Si la recherche n'a aucun résultat
            else {
                $this->session->set_flashdata('info', 'Aucun groupe ne correspond à la recherche');
                redirect(base_url(GROUPES_PATH_I), 'refresh');
            }
        }

        // On charge les groupes
        $data['groupes'] = $this->getGroupes();

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/groupes_view');
        $this->load->view('partials/footer');
    }

    public function create() {
        // On charge les groupes
        $data['groupes'] = $this->getGroupes();

        // On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/admin/groupes_view');
            $this->load->view('partials/footer');
        }
        // Le formulaire a été envoyé
        else {
            $groupe = new Groupe_class();
            $groupe->setLibelle($this->input->post('libelle'));

            $create = $this->groupe_model->create($groupe);
            // Si l'ajout en base de données échoue on signifie l'erreur
            if ($create === FALSE)
                $this->session->set_flashdata('error', "Impossible de créer le groupe en base de données");

            // Le groupe existe déjà
            else if ($create === -1)
                $this->session->set_flashdata('error', "Un groupe avec le même libellé existe déjà");

            // Le groupe a été créé, on affichage un message de succès
            else
                $this->session->set_flashdata('success', "Le groupe " . $groupe->getLibelle() . ' ' . ' a été ajouté');

            // Redirection à l'accueil des groupes
            redirect(base_url(GROUPES_PATH_I), 'refresh');
        }
    }

    public function update() {
        // On charge le modèle etudiant
        $this->load->model('etudiant_model');

        // Le groupe à mettre à jour
        $data['groupe'] = null;

        // On enregistre les identifiants des groupes pour gérer le $_GET
        $ids = array();
        foreach ($this->groupe_model->get_all() as $groupes) {
            $ids [] = $groupes->getIdGroupe();
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement sans $_GET
        if (empty ($_GET['id'])) {
            $this->session->set_flashdata('error', 'Veuillez choisir un groupe à modifier');

            // Redirection vers l'accueil des groupes
            redirect(base_url(GROUPES_PATH_I), 'refresh');
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement avec un $_GET ne correspondant à aucun groupe
        else if ( ! in_array($_GET['id'], $ids)) {
            $this->session->set_flashdata('error', 'Aucun groupe ne correspond à cet identifiant');

            // Redirection vers l'accueil des groupes
            redirect(base_url(GROUPES_PATH_I), 'refresh');
        }

        // Le groupe existe, on le met à jour
        else {
            $data['groupe'] = $this->groupe_model->get_by_id($_GET['id']);

            $this->session->set_userdata('last_groupe', $data['groupe']);

            $data['groupe'][0]->setEtudiants($this->etudiant_model->get_all_by_groupe($data['groupe'][0]->getIdGroupe()));

            // On affiche le formulaire tant qu'il n'a pas été envoyé
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('partials/header', $data);
                $this->load->view('pages/admin/edit_groupe_view');
                $this->load->view('partials/footer');
            }

            // Le formulaire a été envoyé
            else {
                // On modifie le libellé du groupe
                $data['groupe'][0]->setLibelle($this->input->post('libelle'));

                // L'update en base de données a échoué
                if ($this->groupe_model->update($data['groupe'][0]) === -1)
                    $this->session->set_flashdata('warning', "Impossible de mettre à jour le groupe " . $data['groupe'][0]->getLibelle());

                // Le groupe a été mis à jour
                else
                    $this->session->set_flashdata('success', "Le groupe a été mis à jour");

                // Redirection vers la page du groupe
                redirect(base_url(GROUPES_PATH_I . '2?id=' . $data['groupe'][0]->getIdGroupe()), 'refresh');
            }
        }
    }

    public function delete() {
        // On enregistre les identifiants des groupes
        $ids = array();
        foreach ($this->groupe_model->get_all() as $groupes) {
            $ids [] = $groupes->getIdGroupe();
        }

        $data['groupe'] = null;

        // L'utilisateur a essayé de soumettre une URL directement
        if (empty ($_GET['id']))
            $this->session->set_flashdata('error', 'Veuillez choisir un groupe');

        // L'utilisateur a essayé de soumettre une URL directement
        else if ( ! in_array($_GET['id'], $ids))
            $this->session->set_flashdata('error', 'Aucun groupe ne correspond à cet identifiant');

        // Le groupe existe, on le supprime
        else {
            $data['groupe'] = $this->groupe_model->get_by_id($_GET['id']);

            // Erreur base de données
            if ( ! $this->groupe_model->delete($data['groupe'][0]->getIdGroupe()))
                $this->session->set_flashdata('error', 'Impossible de supprimer le groupe ' . $data['groupe'][0]->getLibelle());

            // Le groupe a été supprimé
            else
                $this->session->set_flashdata('success', 'Le groupe ' . $data['groupe'][0]->getLibelle() . ' a été supprimé');
        }

        // Redirection vers l'accueil des groupes
        redirect (base_url(GROUPES_PATH_I), 'refresh');
    }

    public function create_etudiant() {
        // On charge le modèle etudiant
        $this->load->model('etudiant_model');

        $data['groupe'] = $this->groupe_model->get_by_id($_GET['id']);
        $data['etudiants'] = $this->etudiant_model->get_all_by_groupe($data['groupe'][0]->getIdGroupe());

        // On affiche le formulaire tant qu'il n'a pas été envoyé
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('partials/header', $data);
            $this->load->view('pages/admin/edit_groupe_view');
            $this->load->view('partials/footer');
        }

        $etudiant_create = new Etudiant_class();
        $etudiant_create->setPrenom($this->input->post('prenom'));
        $etudiant_create->setNom($this->input->post('nom'));
        $etudiant_create->setIdGroupe($_GET['id']);

        // Tentative d'insertion en base de données
        if ($this->etudiant_model->create($etudiant_create) === FALSE)
            $this->session->set_flashdata('warning', "Erreur lors de la création de l'étudiant " . $etudiant_create->getPrenom() . ' ' . $etudiant_create->getNom());

        // L'étudiant a été créé, on affichage un message de succès
        // et redirection vers la page de gestion des étudiants
        else
            $this->session->set_flashdata('success', "L'étudiant " . $etudiant_create->getPrenom() . ' ' . $etudiant_create->getNom() . ' a été ajouté');

        // Redirection vers la page du groupe en question
        redirect(base_url(GROUPES_PATH_I . '2/?id=' . $_GET['id']), 'refresh');
    }

    public function delete_etudiant() {
        // On charge le modèle etudiant
        $this->load->model('etudiant_model');

        // On enregistre les identifiants des étudiants
        $ids = array();
        foreach ($this->etudiant_model->get_all() as $etudiants) {
            $ids [] = $etudiants->getIdEtudiant();
        }

        $data['etudiant'] = null;

        // L'utilisateur a essayé de soumettre une URL
        // directement sans $_GET
        if (empty ($_GET['et'])) {
            $this->session->set_flashdata('error', 'Veuillez choisir un étudiant');
        }

        // L'utilisateur a essayé de soumettre une URL directement
        // avec un $_GET ne correspondant à aucun groupe
        else if ( ! in_array($_GET['et'], $ids))
            $this->session->set_flashdata('error', 'Aucun étudiant ne correspond à cet identifiant');

        // L'étudiant existe, on le supprime
        else {
            $data['etudiant'] = $this->etudiant_model->get_by_id($_GET['et']);

            echo '<pre>';
            print_r($data['etudiant']);
            echo '</pre>';

            // Erreur base de données
            if ( ! $this->etudiant_model->delete($data['etudiant'][0]->getIdEtudiant()))
                $this->session->set_flashdata('warning', "Impossible de supprimer l'étudiant " . $data['etudiant'][0]->getPrenom() . ' ' . $data['etudiant'][0]->getNom());

            // L'étudiant a été supprimé
            else
                $this->session->set_flashdata('success', "L'étudiant " . $data['etudiant'][0]->getPrenom() . ' ' . $data['etudiant'][0]->getNom() . " a été supprimé");
        }

        // Redirection vers la page du groupe en question
        redirect(base_url(GROUPES_PATH_I . '2/?id=' . $_GET['id']), 'refresh');
    }

    public function update_etudiant() {
        $data['groupes'] = $this->getGroupes();
        $data['etudiants'] = $this->getEtudiants();

        // L'étudiant à mettre à jour
        $data['etudiant'] = null;

        // Chargement des ids pour la gestion d'erreurs du $_GET
        $ids = array();
        foreach ($this->etudiant_model->get_all() as $etudiants) {
            $ids [] = $etudiants->id_etudiant;
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement sans $_GET
        if (empty ($_GET['et'])) {
            $this->session->set_flashdata('error', 'Veuillez choisir un étudiant à modifier');

            // Redirection vers l'accueil des étudiants
            redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
        }

        // L'utilisateur a essayé de soumettre une URL
        // directement avec un $_GET qui ne correspond
        // à aucun étudiant
        else if ( ! in_array($_GET['et'], $ids)) {
            $this->session->set_flashdata('error', 'Aucun étudiant ne correspond à cet identifiant');

            // Redirection vers l'accueil des étudiants
            redirect(base_url(ETUDIANTS_PATH_I), 'refresh');
        }

        // Le $_GET est valide
        else {
            $data['etudiant'] = $this->etudiant_model->get_by_id($_GET['et']);

            // On définit les règles pour la validation du formulaire
            $this->form_validation->set_rules('prenom', 'prénom', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('nom', 'nom', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('groupe', 'groupe', 'required|callback_is_select_valid');

            // On affiche le formulaire tant qu'il n'a pas été envoyé
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('partials/header', $data);
                $this->load->view('pages/admin/edit_etudiant_view');
                $this->load->view('partials/footer');
            }

            // Le formulaire a été soumis
            else {
                // Si la mise a jour échoue on signifie l'erreur et on recharge le formulaire
                if ($this->etudiant_model->update($data['etudiant'][0]) === FALSE)
                    $this->session->set_flashdata('warning', "Impossible de mettre à jour l'étudiant");

                // L'étudiant a été mis à jour, on affiche un message de succès
                else
                    $this->session->set_flashdata('success', "L'étudiant a été mis à jour");

                redirect(base_url(GROUPES_PATH_I . '2?id=' . $_GET['id']), 'refresh');
            }
        }
    }

    /**
     * * * * * * * * * * * * * * * * * * * * *
     */
    public function getGroupes() {
        return $this->groupes;
    }

    public function setGroupes($groupes) {
        $this->groupes = $groupes;
    }
}