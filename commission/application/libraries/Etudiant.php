<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends Personne
{
	private $promotion;
	//private $situation;
	//private $decisions;
	//private $decision_finale;

	public function __set($key, $value)
	{
		if ($key === 'id')
			$this->set_id($value);

		elseif ($key === 'nom')
			$this->set_nom($value);

		elseif ($key === 'prenom')
			$this->set_prenom($value);

		elseif ($key === 'id_promotion')
			$this->get_promotion()->set_id($value);

		elseif ($key === 'libelle')
			$this->get_promotion()->set_libelle($value);
	}
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * *
	 * Récupère l'objet Promotion
	 * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_promotion()
	{
		if ($this->promotion === NULL)
			$this->promotion = new Promotion();

		return $this->promotion;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * *
	 * La situation de l'étudiant
	 * doit contenir au moins 30 caractères
	 * et correspondre à la regex utilisée
	 * * * * * * * * * * * * * * * * * * * * * * * *
	public function get_situation()
	{
		return $this->situation;
	}

	public function set_situation($situation)
	{
		//$regex = "^([ \u00c0-\u01ffa-zA-Z'\-])+$"; // '^([ \u00c0-\u01ffa-zA-Z\'\-])+$^';

		$nom = trim($situation);

		if (strlen($situation) < 30)
			throw new InvalidArgumentException("La situation de l'étudiant doit contenir au moins 30 caractères");

		//elseif ( ! preg_match($regex, $nom))
		//throw new InvalidArgumentException("Le nom de famille contient des caractères illégaux");

		$this->situation = (string) $situation;
	}
	 */
}