<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Decision
{
    private $id;
    private $libelle;

    /**
     * * * * * * * * * * * * * * * * * * * * * * * *
     * Permet d'instancier l'objet directement
     * à l'aide de la fonction custom_result_object
     *
     * $key correspond au champ associé dans la bdd
     * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function __set($key, $value)
    {
        if ($key === 'id')
            $this->set_id($value);

        elseif ($key === 'libelle')
            $this->set_libelle($value);
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * *
     * L'identifiant de la décision
     * doit toujours être positif
     * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $id = str_replace(' ', '', $id);

        if ($id <= 0)
            throw new InvalidArgumentException("L'identifiant de la décision est négatif ou nul");

        $this->id = $id;
    }

    /**
     * * * * * * * * * * * * * * * * * * * * * * * *
     * Le libellé de la décision
     * doit contenir au moins deux caractères
     * et correspondre à la regex utilisée
     * * * * * * * * * * * * * * * * * * * * * * * *
     */
    public function get_libelle()
    {
        return $this->libelle;
    }

    public function set_libelle($libelle)
    {
        $regex = "/^[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z0-9])+))*$/"; // /^([ \u00c0-\u01ffa-zA-Z'\-])+$/

        $libelle = trim($libelle);

        if (strlen($libelle) < 2)
            throw new InvalidArgumentException("La décision doit contenir au moins deux caractères");

        elseif ( ! preg_match($regex, $libelle))
            throw new InvalidArgumentException("La décision contient des caractères illégaux");

        $this->libelle = $libelle;
    }
}