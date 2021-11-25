<?php
class Promotion_model extends Model
{
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param $promotion
	 * @return mixed
	 *      Succès        --> l'identifiant de la promo créée
	 *      Erreur MySQL  --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function create($promotion)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'INSERT INTO promotion ' .
				'(libelle) ' .
				'VALUES (:libelle) '
			);

			$query->bindParam(':libelle', $promotion->get_libelle());
			$query->execute();

			$retour = $db->lastInsertId();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * *
	 * @param $promotion
	 * @return mixed
	 *      Succès        --> TRUE
	 *      Echec         --> FALSE
	 *      Erreur MySQL  --> -1
	 * * * * * * * * * * * * * * * *
	 */
	public function update($promotion)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'UPDATE promotion ' .
				'SET libelle = :libelle ' .
				'WHERE id = :id'
			);

			$query->bindParam(':libelle', $promotion->get_libelle());
			$query->bindParam(':id', $promotion->get_id());

			$retour = $query->execute();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * *
	 * @param $id
	 * @return mixed
	 *      Succès        --> TRUE
	 *      Echec         --> FALSE
	 *      Erreur MySQL  --> -1
	 * * * * * * * * * * * * * * * *
	 */
	public function delete($id)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'DELETE ' .
				'FROM promotion ' .
				'WHERE id = :id'
			);

			$query->bindParam(':id', $id);
			$retour = $query->execute();

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @param $id
	 * @return mixed
	 *      Succès        --> Promotion
	 *      Erreur MySQL  --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_by_id($id)
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT id, libelle ' .
				'FROM promotion ' .
				'WHERE id = :id'
			);

			$query->bindParam(':id', $id);
			$query->execute();

			$retour = $query->fetch(PDO::FETCH_CLASS, "Promotion");

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès        --> Array(Promotion)
	 *      Erreur MySQL  --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	public function get_all()
	{
		$retour = -1;
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT id, libelle ' .
				'FROM promotion'
			);

			$query->execute();

			$retour = $query->fetchAll(PDO::FETCH_CLASS, 'Promotion');

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
		}

		$db = NULL;
		return $retour;
	}
}