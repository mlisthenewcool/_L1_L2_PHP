<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PDF extends Admin {

    private $groupes = array();

    public function __construct() {
        parent::__construct();

        $this->load->library(array('pdf_class', 'form_validation'));
        $this->load->helper('form');
        $this->load->model(array('groupe_model', 'etudiant_model'));

        // On charge les groupes depuis la base de données
        $this->setGroupes($this->groupe_model->get_all());

        // On charge les étudiants pour les groupes
        foreach ($this->getGroupes() as $groupe)
            $groupe->setEtudiants($this->etudiant_model->get_all_by_groupe($groupe->getIdGroupe()));
    }

    public function index()
    {
        $data['title'] = 'PDF';

        $data['groupes'] = $this->getGroupes();

        // Le formulaire a été envoyé pour le trombinoscope
        if ( ! empty ($_POST['trombi'])) {
            if ( ! empty ($_POST['groupes']))
                $this->export_trombi();
            else {
                $this->session->set_flashdata('info', 'Veuillez choisir au moins un groupe');
                redirect(base_url(PDF_PATH_I), 'refresh');
            }
        }
        // Le formulaire a été envoyé pour les accès login/password
        else if ( ! empty ($_POST['auth'])) {
            if ( ! empty ($_POST['groupes']))
                $this->export_authentification();
            else {
                $this->session->set_flashdata('info', 'Veuillez choisir au moins un groupe');
                redirect(base_url(PDF_PATH_I), 'refresh');
            }
        }

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/pdf_view');
        $this->load->view('partials/footer');
    }

    public function export_trombi() {
        $ids = $this->input->post('groupes');

        // On sélectionne les groupes en fonction du formulaire
        $groupes = array();
        for ($i = 0; $i < sizeof($ids); $i++) {
            foreach ($this->getGroupes() as $groupe) {
                if ($ids[$i] === $groupe->getIdGroupe())
                    // if (! in_array($ids[$i], $ids))
                    $groupes [] = $groupe;
            }
        }

        $data['groupes_selected'] = $groupes;

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/pdf_view');
        $this->load->view('partials/footer');

        /*
         * * * * * * * * * *
         * Création du PDF
         * * * * * * * * * *
         */
        $pdf = new Pdf_class(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Infos PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('MagicBanana');

        // Retirer le header et le footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Unifier le font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Ajouter une page pour commencer à écrire
        $pdf->AddPage();

        /*
         * Début de la capture du template
         */
        ob_start();

        // On charge le template avec les groupes sélectionnés
        $this->load->view('templates/trombinoscope', $data['groupes_selected']);

        $template = ob_get_contents();
        $pdf->WriteHTML($template);
        ob_clean();
        /*
         * Fin de la capture du template
         */

        // Affichage du PDF
        $pdf->Output('trombinoscope');
    }

    public function export_authentification() {
        $ids = $this->input->post('groupes');

        // On sélectionne les groupes en fonction du formulaire
        $groupes = array();
        for ($i = 0; $i < sizeof($ids); $i++) {
            foreach ($this->getGroupes() as $groupe) {
                if ($ids[$i] === $groupe->getIdGroupe())
                    // if (! in_array($ids[$i], $ids))
                    $groupes [] = $groupe;
            }
        }

        $data['groupes_selected'] = $groupes;

        $this->load->view('partials/header', $data);
        $this->load->view('pages/admin/pdf_view');
        $this->load->view('partials/footer');

        /*
         * * * * * * * * * *
         * Création du PDF
         * * * * * * * * * *
         */
        $pdf = new Pdf_class(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Infos PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('MagicBanana');

        // Retirer le header et le footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Unifier le font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Ajouter une page pour commencer à écrire
        $pdf->AddPage();

        /*
         * Début de la capture du template
         */
        ob_start();

        // On charge le template avec les groupes sélectionnés
        $this->load->view('templates/authentification', $data['groupes_selected']);

        $template = ob_get_contents();
        $pdf->WriteHTML($template);
        ob_clean();
        /*
         * Fin de la capture du template
         */

        // Affichage du PDF
        $pdf->Output('authentification');
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