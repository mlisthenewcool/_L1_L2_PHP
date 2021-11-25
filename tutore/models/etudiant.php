<?php
class Etudiant_model extends Model
{
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> array(Etudiant)
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function create($etudiant)
	{
		$retour = -1;
		$type = 'etudiant';
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'INSERT INTO personne ' .
				'(nom, prenom, type, id_promotion) ' .
				'VALUES (:nom, :prenom, :type, :id_promotion) '
			);

			$query->bindParam(':nom', $etudiant->get_nom());
			$query->bindParam(':prenom', $etudiant->get_prenom());
			$query->bindParam(':type', $type);
			$query->bindParam(':id_promotion', $etudiant->get_promotion()->get_id());
			$query->execute();

			$retour = $db->lastInsertId();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> TRUE
	 *      Echec                      --> FALSE
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function update($etudiant)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'UPDATE personne ' .
				'SET nom = :nom ' .
				'SET prenom = :prenom ' .
				'SET id_promotion = :id_promotion ' .
				'WHERE id = :id'
			);

			$query->bindParam(':nom', $etudiant->get_nom());
			$query->bindParam(':prenom', $etudiant->get_prenom());
			$query->bindParam(':id_promotion', $etudiant->get_promotion()->get_id());
			$query->bindParam(':id', $etudiant->get_id());

			$retour = $query->execute();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> TRUE
	 *      Echec                      --> FALSE
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function delete($etudiant)
	{
		$retour = -1;
		$type = 'etudiant';
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'DELETE ' .
				'FROM personne ' .
				'WHERE id = :id ' .
				'AND type = :type'
			);

			$query->bindParam(':id', $etudiant->get_id());
			$query->bindParam(':type', $type);

			$retour = $query->execute();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> Etudiant
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_by_id($id)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT id, nom, prenom, id_promotion ' .
				'FROM personne ' .
				'WHERE id = :id'
			);

			$query->bindParam(':id', $id);
			$query->execute();
			$retour = $query->fetch(PDO::FETCH_CLASS, 'Etudiant');

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> array(Etudiant)
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_all()
	{
		$retour = -1;
		$type = 'etudiant';
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT personne.id, nom, prenom, id_promotion, libelle ' .
				'FROM personne, promotion ' .
				'WHERE type = :type ' .
				'AND personne.id_promotion = promotion.id'
			);

			$query->bindParam(':type', $type);
			$query->execute();
			$retour =  $query->fetchAll(PDO::FETCH_CLASS, 'Etudiant');

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}
}