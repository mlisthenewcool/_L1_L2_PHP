<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('etudiant');
	}

	public function get_by_id($id)
	{
		$sql =
			'SELECT personne.id, prenom, nom, id_promotion, libelle ' .
			'FROM personne, promotion ' .
			'WHERE personne.id = ? ' .
			'AND personne.id_promotion = promotion.id';

		$query = $this->db->query($sql, array($id));
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('etudiant');

		/*
		$retour = -1;
		$type = 'etudiant';
		try {
			$db = new PDO('mysql:host=infodb.iutmetz.univ-lorraine.fr;dbname=debernar2u_projet_commission', 'debernar2u', 'Gains!bourg28');

			$query = $db->prepare(
				'SELECT p.id, prenom, nom, pr.id, libelle ' .
				'FROM personne p, promotion pr ' .
				'WHERE id = ? ' .
				'AND type = ? ' .
				'AND p.id = pr.id'
			);

			$query->bindParam(':id', $id);
			$query->bindParam(':type', $type);
			$query->execute();

			$retour = $query->fetchAll(PDO::FETCH_CLASS, 'Etudiant');

		} catch (Exception $e) {
			echo 'Erreur MySQL ' . $e->getMessage();
		}
		$db = NULL;
		return $retour;
		*/

		/*
		$sql =
			'SELECT p.id, prenom, nom, pr.id, libelle ' .
			'FROM personne p, promotion pr ' .
			'WHERE id = ? ' .
			'AND type = ? ' .
			'AND p.id = pr.id';
		$query = $this->db->query($sql, array($id, 'etudiant'));

		$etudiant = new Etudiant();

		foreach ($query->result() as $row)
		{
			$etudiant->set_id($row->id);
			$etudiant->set_prenom($row->prenom);
			$etudiant->set_nom($row->nom);
			//$etudiant->get_promotion()->set_id($row->id);
			$etudiant->get_promotion()->set_libelle($row->libelle);
		}
		var_dump($etudiant);

		$sql_promo =
			'SELECT pr.id, libelle ' .
			'FROM personne p, promotion pr ' .
			'WHERE p.id = ? ' .
			'AND type = ? ' .
			'AND p.id = pr.id';

		$query_promo = $this->db->query($sql_promo, array($id, 'etudiant'));
		$error_promo = $this->db->error();

		if (count($error_promo) > 0 && $error_promo['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error_promo['message']);

		$promo = $query_promo->custom_result_object('promotion');
		var_dump($promo);

		$sql_pers =
			'SELECT id, prenom, nom ' .
			'FROM personne ' .
			'WHERE id = ? ' .
			'AND type = ?';

		$query_pers = $this->db->query($sql_pers, array($id, 'etudiant'));
		$error_pers = $this->db->error();

		if (count($error_pers) > 0 && $error_pers['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error_pers['message']);

		$pers = $query_pers->custom_result_object('etudiant');
		$pers->get_promotion()->set_id($promo->get_id());
		$pers->get_promotion()->set_libelle($promo->get_libelle());

		return $pers;
		*/
	}

	public function get_all()
	{
		$sql =
			'SELECT * ' .
			'FROM personne ' .
			'WHERE type = ?';

		$type = 'etudiant';
		$query = $this->db->query($sql, $type);
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('etudiant');
	}
}