<?php
require_once 'libraries/app/decision.php';
class Commission_model extends Model
{
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> array(Etudiant)
	 *      Erreur MySQL               --> -1
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	 
	 public function delete($id)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'DELETE ' .
                                'FROM decision ' .
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
	 public function create($id)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'INSERT INTO decision ' .
                                '(libelle) ' .
                                'VALUES (:libelle) '
                        );

                        $query->bindParam(':libelle', $libelle->get_libelle());
                        $query->execute();

                        $retour = $db->lastInsertId();

                } catch (Exception $e) {
                        echo 'Erreur MySQL : ' . $e->getMessage();
                }

                $db = NULL;
                return $retour;
        }
		
		public function get_by_id($id)
    {
        $retour = -1;
        try {
            $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare(
                'SELECT id, date_start,date_end,type_vote,fichier_join' .
                'FROM commission ' .
                'WHERE id = :id'
            );

            $query->bindParam(':id', $id);
            $query->execute();

            $retour = $query->fetch(PDO::FETCH_CLASS, "Personne");

        } catch (Exception $e) {
            echo 'Erreur MySQL : ' . $e->getMessage();
        }

        $db = NULL;
        return $retour;
    }
	public function get_all()
	{
		try {
			$db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = $db->prepare(
				'SELECT decision.id, decision.libelle' .
				'FROM decision ' 	
			);

			$query->execute();
			$db = NULL;
			return $query->fetchAll(PDO::FETCH_CLASS, "Etudiant");

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
			$db = NULL;
			return -1;
		}
	}
	
	public function update($id)
    {
        $retour = -1;

        try {
            $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE decision SET decision.libelle WHERE id='?'";
            $req = $this->db->prepare($sql);
            $d = array($libelle);
            $req->execute($d);

        $response=$query ->fetchAll(PDO::FETCH_CLASS,);

            
            if (count($response) === 1)
                $retour = $response['id'];

        } catch (Exception $e) {
            echo 'Erreur MySQL : ' . $e->getMessage();
        }

        $db = NULL;
        return $retour;
    }
	 
}