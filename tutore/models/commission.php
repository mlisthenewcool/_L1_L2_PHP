<?php
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
				'FROM commission ' .
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
		
		public function create_secret($date_start, $date_end, $fichier_joint)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'INSERT INTO commision ' .
                                '(date_start, date_end, type_vote, fichier_joint) ' .
                                'VALUES (:date_sart, :date_end, 'secret', fichier_joint) '
                        );

                        $query->bindParam(':date_start', $date_start->get_date_start());
                        $query->bindParam(':date_end', $date_end->get_date_end());
                        $query->bindParam(':fichier_joint', $fichier_joint->get_fichier_joint());
                        $query->execute();

                        $retour = $db->lastInsertId();

                } catch (Exception $e) {
                        echo 'Erreur MySQL : ' . $e->getMessage();
                }

                $db = NULL;
                return $retour;
        }
		public function create_public($date_start, $date_end, $fichier_joint)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'INSERT INTO commision ' .
                                '(date_start, date_end, type_vote, fichier_joint) ' .
                                'VALUES (:date_sart, :date_end, 'public', fichier_joint) '
                        );

                        $query->bindParam(':date_start', $date_start->get_date_start());
                        $query->bindParam(':date_end', $date_end->get_date_end());
                        $query->bindParam(':fichier_joint', $fichier_joint->get_fichier_joint());
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
				'SELECT commission.id, commission.date_start, commission.date_end, commission.type_vote, commission.fichier_join ' .
				'FROM commission ' 
				
			);

			//$type = 'etudiant';
			//$query->bindParam(':type', $type);

			$query->execute();
			$db = NULL;
			return $query->fetchAll(PDO::FETCH_CLASS, "Etudiant");

		} catch (Exception $e) {
			echo 'Erreur MySQL : ' . $e->getMessage();
			$db = NULL;
			return -1;
		}
	}
	
	public function update($id,$nom,$prenom,$type,$email,$id_auth,$id_promotion)
    {
        $retour = -1;

        try {
            $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
            $sql = "UPDATE commission SET commission.date_start='?', commission.date_end='?', commission.type_vote='?'";//, commission.fichier_joint";
            $req = $this->db->prepare($sql);
            $d = array($date_start,$date_end,$type_vote,$);
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