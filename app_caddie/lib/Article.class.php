<?php

class Article
{
    private $reference;
    private $designation;
    private $prixUnitaire;

    public function __construct($reference, $designation, $prixUnitaire) {
        $this->reference = $reference;
        $this->designation = $designation;
        $this->prixUnitaire = $prixUnitaire;
    }

    public function afficher() {
        echo (
            '<td class="text-center">' . $this->getReference() . '</td>' .
            '<td class="text-center">' . $this->getDesignation() . '</td>' .
            '<td class="text-center">' . $this->getPrix() . '</td>'
        );
    }

    public function getDesignation() {
        return $this->designation;
    }
    public function setDesignation($designation) {
        $this->designation = $designation;
    }

    public function getReference() {
        return $this->reference;
    }
    public function setReference($reference) {
        $this->reference = $reference;
    }

    public function getPrix() {
        return $this->prixUnitaire;
    }
    public function setPrix($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }
}