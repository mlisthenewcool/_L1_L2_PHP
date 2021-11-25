<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentification_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($login, $password, $type)
	{
		$sql =
			'SELECT id ' .
 			'FROM authentification ' .
			'WHERE login = ? AND password = ? AND type = ?';

		$user = $this->db->query($sql, array($login, $password, $type));

		if ($user->num_rows() === 1)
			return $user->row()->id;
		else
			return -1;
	}
}