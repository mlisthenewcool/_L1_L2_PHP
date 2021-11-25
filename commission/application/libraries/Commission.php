<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission
{
	private $id;
	private $date_start;
	private $date_end;
	private $type_vote;

	private $etudiants = array();
	private $professeurs = array();
	/*
	private $etudiants = array(
		array(
			'etudiant' => NULL,
			'description' => NULL,
			'decisions' => array(),
			'decision_finale' => NULL
		)
	);

	private $professeurs = array(
		array(
			'prof' => NULL,
			'etudiant' => NULL,
			'vote' => NULL
		)
	);
	*/

	private $file;

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_id()
	{
		return $this->id;
	}

	public function set_id($id)
	{
		$this->id = $id;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_date_start()
	{
		return $this->date_start;
	}

	public function set_date_start($date_start)
	{
		$this->date_start = $date_start;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_date_end()
	{
		return $this->date_end;
	}

	public function set_date_end($date_end)
	{
		$this->date_end = $date_end;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_type_vote()
	{
		return $this->type_vote;
	}

	public function set_type_vote($type_vote)
	{
		$this->type_vote = $type_vote;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_etudiants()
	{
		return $this->etudiants;
	}

	public function set_etudiants($etudiants)
	{
		$this->etudiants = $etudiants;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_professeurs()
	{
		return $this->professeurs;
	}

	public function set_professeurs($professeurs)
	{
		$this->professeurs = $professeurs;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function get_file()
	{
		return $this->file;
	}

	public function set_file($file)
	{
		$this->file = $file;
	}

}