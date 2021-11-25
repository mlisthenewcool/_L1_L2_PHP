<?php
class Login_model extends Model
{
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param $login
	 * @param $password
	 * @param $type
	 * @return mixed
	 *      Succès                     --> l'identifiant de l'user
	 *      Pas ou plusieurs résultats --> FALSE
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function connexion($login, $password, $type)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT id ' .
				'FROM authentification ' .
				'WHERE login = :login ' .
				'AND password = :password ' .
				'AND type = :type'
			);

			$query->bindParam(':login', $login);
			$query->bindParam(':password', $password);
			$query->bindParam(':type', $type);

			$query->execute();

			$response = $query->fetch(PDO::FETCH_ASSOC);

			if (count($response) === 1)
				$retour = $response['id'];
			else
				$retour = FALSE;

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}
}

