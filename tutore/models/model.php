<?php
class Model
{
	protected $hostname;
	protected $dbname;
	protected $username;
	protected $password;

	public function __construct()
	{
		$this->hostname = 'mysql:host=' . 'infodb.iutmetz.univ-lorraine.fr';
		$this->dbname = ';dbname=' . 'debernar2u_projet_commission';
		$this->username = 'debernar2u';
		$this->password = 'Gains!bourg28';
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * (pour une requête de type INSERT)
	 * l'architecture d'InnoDB ne permet pas de bloquer l'incrémentation d'une clé en AutoIncrement
	 * lorsque l'un des champs suivants n'a pas pu être inséré (par ex. un attribut en UNIQUE KEY)
	 * http://stackoverflow.com/questions/2787910/why-does-mysql-autoincrement-increase-on-failed-inserts
	 *
	 * solutions plus rapides :
	 * INSERT IGNORE + SELECT @@warning_count (https://dev.mysql.com/doc/refman/5.7/en/sql-mode.html#sql-mode-strict)
	 * INSERT ON DUPLICATE KEY UPDATE
	 * http://stackoverflow.com/questions/548541/insert-ignore-vs-insert-on-duplicate-key-update#548570
	 * http://stackoverflow.com/questions/5924762/prevent-autoincrement-on-mysql-duplicate-insert?rq=1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */

	/*
	// la ligne suivante permet de réajuster la valeur de la clé auto_incrémentée avec sa valeur avant la clause INSERT
	$this->db->query('ALTER TABLE class AUTO_INCREMENT = ' . $this->db->insert_id());

	// @see liste des constantes d'erreur MySql (doc api oracle) http://dev.mysql.com/doc/refman/5.6/en/error-messages-server.html
	if ($error['code'] === 1062)
		throw new ObjectAlreadyExistsException("Une classe avec le même libellé existe déjà !");
	if ($error['code'] > 0)
		throw new DataAccessException("Erreur MySql : " . $error['message']);
	*/
}