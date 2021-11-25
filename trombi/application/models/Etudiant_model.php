<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_model extends CI_Model {

    /**
     * * * * * * * * * * * * * * * * * * * *
     * Charge l'accès à la base de données
     * @see application/config/database.php
     * * * * * * * * * * * * * * * * * * * *
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * * * * * * * * * * * * * * * * * * *
     * @param $login
     * @param $password
     * @return succès ? id_etudiant : -1
     * * * * * * * * * * * * * * * * * * *
     */
    public function login($login, $password) {
        $sql = 'SELECT user_id
                FROM user
                WHERE login = ?
                AND password = ?
                AND user_type = ?';
        $etudiant = $this->db->query($sql, array($login, $password, 'etudiant'));

        if ($etudiant->num_rows() === 1)
            return $etudiant->row()->user_id;
        else
            return -1;
    }

    /**
     * * * * * * * * * * * * * * * * * *
     * @param Etudiant_class $etudiant
     * @return succès ? true : false
     * * * * * * * * * * * * * * * * * *
     */
    public function create($etudiant) {
        $this->load->library(array('Etudiant_class')); // 'Password_class'
        $this->load->helper(array('random', 'text'));

        // Table etudiant
        $sql_etudiant = 'INSERT INTO etudiant
                         (prenom, nom, id_groupe)
                         VALUES (?, ?, ?)';
        $query_etudiant = $this->db->query($sql_etudiant, array($etudiant->getPrenom(), $etudiant->getNom(), $etudiant->getIdGroupe()));

        // Table user pour l'authenfication
        // login -> 6 premières lettres du nom + id étudiant + t
        if ( strlen($etudiant->getNom()) < 6 )
            $login = $etudiant->getNom() . $this->db->insert_id() . 't';
        else
            $login = strtolower(substr($etudiant->getNom(), 0, 6) . $this->db->insert_id() . 't');
        /*
        // login -> 4 premières lettres du prenom + id étudiant + 4 premières lettres du nom
        if ( strlen($etudiant->getPrenom()) < 4 && strlen($etudiant->getNom()) < 4 )
            $login = strtolower($etudiant->getPrenom() . $this->db->insert_id() . $etudiant->getNom());
        else if ( strlen($etudiant->getPrenom()) < 4 )
            $login = strtolower($etudiant->getPrenom() . $this->db->insert_id() . substr($etudiant->getNom(), 0, 4));
        else if ( strlen($etudiant->getNom()) < 4 )
            $login = strtolower(substr($etudiant->getPrenom(), 0, 4) . $this->db->insert_id() . $etudiant->getNom());
        else
            $login = strtolower(substr($etudiant->getPrenom(), 0, 4) . $this->db->insert_id() . substr($etudiant->getNom(), 0, 4));
        */

        // password -> entre 6 et 8 caractères générés aléatoirement
        /**  @see application/helpers/random_helper.php **/
        $password = get_random_password();
        /** @see application/libraries/Password_class.php **/
        // $hash = $this->password_class->create_hash($password);

        $sql_auth = 'INSERT INTO user
                     (user_id, login, password, user_type)
                     VALUES (?, ?, ?, ?)';
        $query_auth = $this->db->query($sql_auth, array($this->db->insert_id(), $login, $password/*$hash*/, 'etudiant'));

        if ($query_etudiant === TRUE && $query_auth === TRUE)
            return true;
        else
            return false;
    }

    /**
     * * * * * * * * * * * * * * * * * * *
     * @param $etudiant
     * @return succès ? id_etudiant : -1
     * * * * * * * * * * * * * * * * * * *
     */
    public function update($etudiant) {
        $this->load->library('Etudiant_class');

        // Table étudiant
        $sql_etudiant = 'UPDATE etudiant
                         SET prenom = ?, nom = ?, id_groupe = ?
                         WHERE id_etudiant = ?';
        $query_etudiant = $this->db->query($sql_etudiant, array($etudiant->getPrenom(), $etudiant->getNom(), $etudiant->getIdGroupe(), $etudiant->getIdEtudiant()));

        // Table user pour l'authenfication
        // login -> 6 premières lettres du nom + id étudiant + t
        if ( strlen($etudiant->getNom()) < 6 )
            $login = $etudiant->getNom() . $this->db->insert_id() . 't';
        else
            $login = strtolower(substr($etudiant->getNom(), 0, 6) . $this->db->insert_id() . 't');

        /*
        // login -> 4 premières lettres du prenom + id étudiant + 4 premières lettres du nom
        if ( strlen($etudiant->getPrenom()) < 4 && strlen($etudiant->getNom()) < 4 )
            $login = strtolower($etudiant->getPrenom() . $etudiant->getIdEtudiant() . $etudiant->getNom());
        else if ( strlen($etudiant->getPrenom()) < 4 )
            $login = strtolower($etudiant->getPrenom() . $etudiant->getIdEtudiant() . substr($etudiant->getNom(), 0, 4));
        else if ( strlen($etudiant->getNom()) < 4 )
            $login = strtolower(substr($etudiant->getPrenom(), 0, 4) . $etudiant->getIdEtudiant() . $etudiant->getNom());
        else
            $login = strtolower(substr($etudiant->getPrenom(), 0, 4) . $etudiant->getIdEtudiant() . substr($etudiant->getNom(), 0, 4));
        */

        $sql_auth = 'UPDATE user
                     SET login = ?
                     WHERE user_id = ?';
        $query_auth = $this->db->query($sql_auth, array($login, $etudiant->getIdEtudiant()));

        if ($query_etudiant === true && $query_auth === true)
            return $etudiant->getIdEtudiant();
        else
            return -1;
    }

    /**
     * * * * * * * * * * * * * * * * *
     * @param $id
     * @return succès ? true : false
     * * * * * * * * * * * * * * * * *
     */
    public function delete($id) {
        $sql_auth = 'DELETE
                     FROM user
                     WHERE user_id = ?';
        $query_auth = $this->db->query($sql_auth, array($id));
    
        $sql_etudiant = 'DELETE
                         FROM etudiant
                         WHERE id_etudiant = ?';
        $query_etudiant = $this->db->query($sql_etudiant, array($id));

        if ($query_etudiant === true && $query_auth === true)
            return true;
        else
            return false;
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * @param $id
     * @return etudiant trouvé ? (Etudiant_class) $etudiant : null
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_by_id($id) {
        $this->load->library('Etudiant_class');

        $sql = 'SELECT id_etudiant, nom, prenom, libelle AS groupe, photo, login, password
                FROM etudiant e, groupe g, user
                WHERE id_etudiant = ?
                AND e.id_groupe = g.id_groupe
                AND user_id = id_etudiant';
        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() === 1)
            return $query->custom_result_object('Etudiant_class');

        else
           return null;
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     * @param $groupe
     * @return $array (Etudiant_class) $etudiants
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_all_by_groupe($groupe) {
        $this->load->library('Etudiant_class');

        $sql = 'SELECT id_etudiant, nom, prenom, libelle AS groupe, photo, login, password
                FROM groupe g, etudiant e, user
                WHERE e.id_groupe = ?
                AND g.id_groupe = ?
                AND user_id = id_etudiant';
        $query = $this->db->query($sql, array($groupe, $groupe));

        return $query->custom_result_object('Etudiant_class');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     * @return $array (Etudiant_class) $etudiants
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_all() {
        $this->load->library('Etudiant_class');

        $sql = 'SELECT id_etudiant, nom, prenom, e.id_groupe, libelle AS groupe, photo, login, password
                FROM etudiant e, groupe g, user
                WHERE e.id_groupe = g.id_groupe
                AND user_id = id_etudiant';
        $query = $this->db->query($sql, array());

        return $query->custom_result_object('Etudiant_class');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     * @return $array (Etudiant_class) $etudiants
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function rechercher($recherche) {
        $this->load->library('Etudiant_class');

        // Un petit nettoyage rapide (bien trop rapide)
        $recherche = htmlspecialchars($recherche);

        $sql = "SELECT id_etudiant, nom, prenom, g.id_groupe, libelle AS groupe, photo, login, password
                FROM etudiant e, groupe g, user
                WHERE nom LIKE '%" . $recherche . "%'
                AND e.id_groupe = g.id_groupe
                AND user_id = id_etudiant
                UNION
                SELECT id_etudiant, nom, prenom, g.id_groupe, libelle AS groupe, photo, login, password
                FROM etudiant e, groupe g, user
                WHERE prenom LIKE '%" . $recherche . "%'
                AND e.id_groupe = g.id_groupe
                AND user_id = id_etudiant";
        $query = $this->db->query($sql);

        return $query->custom_result_object('Etudiant_class');
    }

    /**
     * * * * * * * * * * * * * * * * *
     * @param $id_etudiant
     * @param $image
     * @return succès ? true : false
     * * * * * * * * * * * * * * * * *
     */
    public function upload_image($photo, $id_etudiant) {
        $sql = 'UPDATE etudiant
                SET photo = ?
                WHERE id_etudiant = ?';

        return $this->db->query($sql, array($photo, $id_etudiant));
    }
}