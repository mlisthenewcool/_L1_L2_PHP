<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe_model extends CI_Model {

    /**
     * * * * * * * * * * * * * * * * * * * *
     * Charge l'accès à la base de données
     * @see application/config/database.php
     * * * * * * * * * * * * * * * * * * * *
     */
    public function __construct() {
        $this->load->database();

        $this->load->library('Groupe_class');
    }

    /**
     * * * * * * * * * * * * * * * * * *
     * @param Groupe_class $groupe
     * @return succès ? true : false
     * @return -1 si le libellé existe déjà
     * * * * * * * * * * * * * * * * * *
     */
    public function create(Groupe_class $groupe) {
        $this->load->library(array('Groupe_class'));

        $sql_exist = 'SELECT *
                      FROM groupe
                      WHERE libelle = ?';

        $exist = $this->db->query($sql_exist, array($groupe->libelle));

        if ($exist->num_rows() !== 0)
            return -1;

        $sql = 'INSERT INTO groupe
                (libelle)
                VALUES (?)';

        return $this->db->query($sql, array($groupe->libelle));
    }

    /**
     * * * * * * * * * * * * * * * * * *
     * @param $groupe
     * @return succès ? id_groupe : -1
     * * * * * * * * * * * * * * * * * *
     */
    public function update(Groupe_class $groupe) {
        $this->load->library('Groupe_class');

        $sql = 'UPDATE groupe
                SET libelle = ?
                WHERE id_groupe = ?';
        $query = $this->db->query($sql, array($groupe->getLibelle(), $groupe->getIdGroupe()));

        if ($query === true)
            return $groupe->getIdGroupe();
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
        $this->load->model('etudiant_model');
        foreach ($this->etudiant_model->get_all_by_groupe($id) as $etudiant)
            $this->etudiant_model->delete($etudiant->getIdEtudiant());

        $sql = 'DELETE
                FROM groupe
                WHERE id_groupe = ?';

        return $this->db->query($sql, array($id));
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * @param $id
     * @return groupe trouvé ? (Groupe_class) $groupe : null
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_by_id($id) {
        $sql = 'SELECT * 
                FROM groupe
                WHERE id_groupe = ?';
        $query = $this->db->query($sql, array($id));

        return $query->custom_result_object('Groupe_class');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * @param $libelle
     * @return groupe trouvé ? (Groupe_class) $groupe : null
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_by_libelle($libelle) {
        $sql = 'SELECT * 
                FROM groupe
                WHERE libelle = ?';
        $query = $this->db->query($sql, array($libelle));

        return $query->custom_result_object('Groupe_class');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * *
     * @return $array (Groupe_class) $groupes
     * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_all() {
        $sql = 'SELECT * FROM groupe';
        $query = $this->db->query($sql);

        return $query->custom_result_object('Groupe_class');
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * *
     * @return $array (Groupe_class) $groupes
     * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function rechercher($recherche) {
        $sql = "SELECT *
                FROM groupe
                WHERE libelle LIKE '%" . $recherche . "%'";
        $query = $this->db->query($sql);

        return $query->custom_result_object('Groupe_class');
    }
}

