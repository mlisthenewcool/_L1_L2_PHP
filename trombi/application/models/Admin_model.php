<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /**
     * * * * * * * * * * * * * * * * * * * *
     * Admin_model constructor.
     * Charge l'accès à la base de données
     * @see application/config/database.php
     * * * * * * * * * * * * * * * * * * * *
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * * * * * * * * * * * * * * * * *
     * @param $login
     * @param $password
     * @return succès ? id_admin : -1
     * * * * * * * * * * * * * * * * *
     */
    public function login($login, $password) {
        $sql = 'SELECT user_id FROM user WHERE login = ? AND password = ? AND user_type = ?';
        $admin = $this->db->query($sql, array($login, $password, 'admin'));

        if ($admin->num_rows() === 1)
            return $admin->row()->user_id;
        else
            return -1;
    }

    /**
     * * * * * * * * * * * * * * * * * *
     * @param $groupes
     * @return succès ? true : false
     * * * * * * * * * * * * * * * * * *
     */
    public function import_csv($groupes, $etudiants) {
        $this->load->model(array('Groupe_model', 'Etudiant_model'));

        foreach ($groupes as $groupe) {
            // Erreur d'insertion d'un groupe
            if ( ! $this->groupe_model->create($groupe)) {
                // throw new mysqli_sql_exception();
                return false;
            }
        }

        foreach ($etudiants as $etudiant) {
            $groupe = $this->groupe_model->get_by_libelle($etudiant->getGroupe());
            $etudiant->setIdGroupe($groupe[0]->getIdGroupe());

            // Erreur d'insertion d'un étudiant
            if ( ! $this->etudiant_model->create($etudiant)) {
                // throw new mysqli_sql_exception();
                return false;
            }
        }

        return true;
    }

    public function create_admin() {
        $this->load->library('Password_class');
        /** @see application/libraries/Password_class.php **/
        $hash = $this->password_class->create_hash('patron');

        $sql = 'INSERT into user (user_id, login, user_type, password) VALUES (1000000, ?, ?, ?)';

        return $this->db->query($sql, array('admin', 'admin', 'patron' /*$hash*/));
    }

    public function create_prof() {
        $this->load->library('Password_class');
        /** @see application/libraries/Password_class.php **/
        $hash = $this->password_class->create_hash('patron');

        $sql = 'INSERT into user (user_id, login, user_type, password) VALUES (999999, ?, ?, ?)';

        return $this->db->query($sql, array('prof', 'professeur', 'patron' /*$hash*/));
    }

    public function truncate() {
        $sql_etudiant = 'TRUNCATE etudiant';
        $sql_groupe = 'TRUNCATE groupe';
        $sql_user = 'TRUNCATE user';

        $this->db->query($sql_etudiant);
        $this->db->query($sql_groupe);
        $this->db->query($sql_user);

        $this->create_admin();
        $this->create_prof();
    }
}

