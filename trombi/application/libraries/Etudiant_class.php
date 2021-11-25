<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_class {
    private $id_etudiant;
    private $prenom;
    private $nom;
    private $groupe;
    private $id_groupe;
    private $photo;
    private $login;
    private $password;

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
        if ($key === 'id_etudiant')
            $this->setIdEtudiant($value);

        else if ($key === 'prenom')
            $this->setPrenom($value);

        else if ($key === 'nom')
            $this->setNom($value);

        else if ($key === 'groupe')
            $this->setGroupe($value);

        else if ($key === '_id_groupe')
            $this->setIdGroupe($value);

        else if ($key === 'photo')
            $this->setPhoto($value);

        else if ($key === 'login')
            $this->setLogin($value);

        else if ($key === 'password')
            $this->setPassword($value);
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getIdEtudiant() {
        return $this->id_etudiant;
    }

    public function setIdEtudiant($id_etudiant) {
        if ($id_etudiant <= 0)
            throw new InvalidArgumentException("L'identifiant de l'étudiant est négatif ou nul");

        $this->id_etudiant = trim($id_etudiant);
    }
    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = trim($nom);
    }
    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = trim($prenom);
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getGroupe() {
        return $this->groupe;
    }

    public function setGroupe($groupe) {
        $this->groupe = trim($groupe);
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getIdGroupe() {
        return $this->id_groupe;
    }

    public function setIdGroupe($id) {
        if ($id <= 0)
            throw new InvalidArgumentException("Le numéro du groupe est négatif ou nul");

        $this->id_groupe = trim($id);
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getPhoto() {
        if (empty ($this->photo) || $this->photo === '')
            $this->setPhoto('magicBanana.png');

        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = trim($photo);
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}