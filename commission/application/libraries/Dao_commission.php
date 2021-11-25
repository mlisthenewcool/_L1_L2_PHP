<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_Commission
{
	private static $instance;
	private $commission;

	public function __construct()
	{
		$this->commission = new Commission();
	}

	public static function &get_instance()
	{
		if ( ! self::$instance)
			self::$instance = new Dao_Commission();

		return self::$instance;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function ajouter_etudiant(Etudiant $etudiant)
	{
		$etudiants = $this->get_commission()->get_etudiants();

		if(count($etudiants = $this->commission->get_etudiants()) > 0)
		{
			foreach($etudiants as $etu)
			{
				if($etu['etudiant']->get_id() === $etudiant->get_id())
					return FALSE;
			}
		}
		/*
		for($i = 0; $i < sizeof($etudiants); $i++)
		{
			//var_dump($etudiants[$i]['etudiant']);
			if($etudiant->get_id() === $etudiants[$i]['etudiant']->get_id())
				return FALSE;
		}
		*/

		$array_etudiant = array(
			'etudiant' => $etudiant,
			'description' => NULL,
			'decisions' => array(),
			'decision_finale' => NULL
		);

		$etudiants[] = $array_etudiant;
		$this->get_commission()->set_etudiants($etudiants);

		//echo '<pre>';
		//print_r($this->get_commission()->get_etudiants());
		//echo '</pre>';

		return TRUE;
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function supprimer_etudiant($id)
	{

	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function ajouter_description_etudiant($id, $description)
	{
		$etudiants = $this->get_commission()->get_etudiants();

		/*
		$array_etudiant['etudiant'] = NULL;
		$array_etudiant['description'] = NULL;
		$array_etudiant['decisions'] = array();
		$array_etudiant['decision_finale'] = NULL;

		$array_etudiant = array(
			'etudiant' => NULL,
			'description' => NULL,
			'decisions' => array(),
			'decision_finale' => NULL
		);
		*/
		$array_etudiant = NULL;
		
		foreach($etudiants as $etudiant)
		{
			if($etudiant['etudiant']->get_id() === $id)
			{
				$array_etudiant = array(
					'etudiant' => $etudiant,
					'description' => $description,
					'decisions' => array(),
					'decision_finale' => NULL
				);
				//$array_etudiant['description'] = $description;
			}
		}
		/*
		echo '<pre>';
		print_r($array_etudiant);
		echo '</pre>';
		*/

		//$this->get_commission()->set_etudiants($temp);
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function ajouter_decisions_etudiant()
	{

	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	public function ajouter_decision()
	{

	}

	public function get_commission()
	{
		return $this->commission;
	}
}