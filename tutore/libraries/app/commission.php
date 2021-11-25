<?php
class Commission
{
    private $id;
    private $date_start;
    private $date_end;
    private $type_vote;
    /**
     * @array $etudiants
     *
     * Tableau associatif
     * ['etudiant']['description'] => 'decision_finale'
     */
    private $etudiants;
    /**
     * @array $professeurs
     *
     * Tableau associatif
     * ['prof']['etudiant'] => 'vote'
     */
    private $professeurs;

    /**
     * @array $decisions
     *
     * Tableau associatif
     * ['etudiant'] => array('decisions_proposées')
     */
    private $decisions;

    /**
     * @string $file
     *
     * (Optionnel)
     * Le fichier joint pour la commission
     */
    private $file;
}