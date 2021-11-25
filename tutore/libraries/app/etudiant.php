<?php
class Etudiant extends Personne
{
	public $promotion;

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
}