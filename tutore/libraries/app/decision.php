<?php
class Decision
{
	private $id;
	private $libelle;

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

		$this->id = (int) $id;
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

		$this->libelle = (string) $libelle;
	}
}