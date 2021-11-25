<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param Promotion $promotion
	 * @throws ObjectAlreadyExists (libellé)
	 * @throws DataAccess (autre erreur MySql)
	 * @return l'identifiant de la classe créée
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function create($promotion)
	{
		$sql =
			'INSERT INTO promotion ' .
			'(libelle) ' .
			'VALUES (?)';

		$this->db->query($sql, $promotion->get_libelle());
		$id = $this->db->insert_id();

 		$error = $this->db->error();
		if (count($error) > 0)
		{
			$this->db->query('ALTER TABLE promotion AUTO_INCREMENT = ' . $this->db->insert_id());

			if ($error['code'] === 1062)
				throw new ObjectAlreadyExists("Une promotion avec le même libellé existe déjà !");
			elseif ($error['code'] != 0)
				throw new DataAccess("Erreur MySql : " . $error['message']);
		}

		return $id;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param Promotion $promotion
	 * @throws ObjectAlreadyExists (libellé)
	 * @throws DataAccess (autre erreur MySql)
	 * @return TRUE
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function update($promotion)
	{
		$sql =
			'UPDATE promotion ' .
      'SET libelle = ? ' .
			'WHERE id = ?';

		$this->db->query($sql, array($promotion->get_libelle(), $promotion->get_id()));
		$error = $this->db->error();

		if (count($error) > 0)
		{
			if ($error['code'] === 1062)
				throw new ObjectAlreadyExists("Une classe avec le même libellé existe déjà !");
			elseif ($error['code'] != 0)
				throw new DataAccess("Erreur MySql : " . $error['message']);
		}

		return TRUE;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param int $id
	 * @throws DataAccess (autre erreur MySql)
	 * @return TRUE
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function delete($id)
	{
		$sql =
			'DELETE ' .
			'FROM promotion ' .
			'WHERE id = ?';

		$this->db->query($sql, array($id));
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return TRUE;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param int $id
	 * @throws DataAccess (autre erreur MySql)
	 * @return succès ? Promotion : null
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_by_id($id)
	{
		$sql =
			'SELECT * ' .
			'FROM promotion ' .
			'WHERE id = ?';

		$query = $this->db->query($sql, array($id));
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('promotion');
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param int $id
	 * @throws DataAccess (autre erreur MySql)
	 * @return succès ? array(Promotion) : null
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_all()
	{
		$sql =
			'SELECT * ' .
			'FROM promotion';

		$query = $this->db->query($sql);
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('promotion');
	}
}