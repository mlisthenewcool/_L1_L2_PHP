<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe_class {
    private $id_groupe;
    private $libelle;
    private $etudiants = array();

    public function __get($key) {
        if (isset($this->$key))
            return $this->$key;
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * *
     * Permet d'instancier l'objet directement
     * à l'aide de la fonction custom_result_object
     * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function __set($key, $value) {
        if ($key === 'id_groupe')
            $this->setIdGroupe($value);

        else if ($key === 'libelle')
            $this->setLibelle($value);

        else if ($key === 'etudiants')
            $this->setEtudiants($value);
    }

    /*
    public function add_etudiant(Etudiant_class $etudiant) {
        $temp = $this->getEtudiants();
        $temp [] = $etudiant;
        $this->setEtudiants($temp);

        /*
        echo '<pre>';
        print_r($temp);
        echo '</pre>';

        $this->etudiants [] = $etudiant;
     }
    */

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getIdGroupe() {
        return $this->id_groupe;
    }

    public function setIdGroupe($id_groupe) {
        if ($id_groupe <= 0)
            throw new InvalidArgumentException("Le numéro du groupe est négatif ou nul");

        $this->id_groupe = trim($id_groupe);
    }
    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = trim($libelle);
    }
    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getEtudiants() {
        return $this->etudiants;
    }

    public function setEtudiants($etudiants = array()) {
        $this->etudiants = $etudiants;
    }
}