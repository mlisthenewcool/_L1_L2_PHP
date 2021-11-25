<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Decision_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('decision');
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param Decision $decision
	 * @throws ObjectAlreadyExists (libellé)
	 * @throws DataAccess (autre erreur MySql)
	 * @return l'identifiant de la classe créée
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function create($decision)
	{
		$sql =
			'INSERT INTO decision ' .
			'(libelle) ' .
			'VALUES (?)';

		$this->db->query($sql, $decision->get_libelle());
		$id = $this->db->insert_id();

		$error = $this->db->error();
		if (count($error) > 0)
		{
			$this->db->query('ALTER TABLE promotion AUTO_INCREMENT = ' . $this->db->insert_id());

			if ($error['code'] === 1062)
				throw new ObjectAlreadyExists("Une décision avec le même libellé existe déjà !");
			elseif ($error['code'] != 0)
				throw new DataAccess("Erreur MySql : " . $error['message']);
		}

		return $id;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param Decision $decision
	 * @throws ObjectAlreadyExists (libellé)
	 * @throws DataAccess (autre erreur MySql)
	 * @return TRUE
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function update($decision)
	{
		$sql =
			'UPDATE decision ' .
			'SET libelle = ? ' .
			'WHERE id = ?';

		$this->db->query($sql, array($decision->get_libelle(), $decision->get_id()));
		$error = $this->db->error();

		if (count($error) > 0)
		{
			if ($error['code'] === 1062)
				throw new ObjectAlreadyExists("Une décision avec le même libellé existe déjà !");
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
			'FROM decision ' .
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
	 * @return succès ? Decision : null
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_by_id($id)
	{
		$sql =
			'SELECT * ' .
			'FROM decision ' .
			'WHERE id = ?';

		$query = $this->db->query($sql, array($id));
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('decision');
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param int $id
	 * @throws DataAccess (autre erreur MySql)
	 * @return succès ? array(Decision) : null
	 * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_all()
	{
		$sql =
			'SELECT * ' .
			'FROM decision';

		$query = $this->db->query($sql);
		$error = $this->db->error();

		if (count($error) > 0 && $error['code'] != 0)
			throw new DataAccess("Erreur MySql : " . $error['message']);

		return $query->custom_result_object('decision');
	}
}