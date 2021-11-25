<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professeur_model extends CI_Model {

    /**
     * * * * * * * * * * * * * * * * * * * *
     * Professeur_model constructor.
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
     * @return succès ? id_prof : -1
     * * * * * * * * * * * * * * * * *
     */
    public function login($login, $password) {
        $sql = 'SELECT user_id FROM user WHERE login = ? AND password = ? AND user_type = ?';
        $prof = $this->db->query($sql, array($login, $password, 'professeur'));

        if ($prof->num_rows() === 1)
            return $prof->row()->user_id;
        else
            return -1;
    }
}