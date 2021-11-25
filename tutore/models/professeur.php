<?php
require_once 'libraries/app/professeur.php';
class Professeur_model extends Model
{
	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * @return mixed
	 *      Succès                     --> array(Etudiant)
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
                'SELECT id, nom,prenom,type,email,id_auth,id_promotion ' .
                'FROM personne ' .
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
				'SELECT personne.id, nom, prenom, id_promotion, libelle ' .
				'FROM personne, promotion ' .
				'WHERE type = :type ' .
				'AND personne.id_promotion = promotion.id'
			);

			$type = 'etudiant';
			$query->bindParam(':type', $type);

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

            $sql = "UPDATE personne SET personne.nom='?', personne.prenom='?', personne.type='?', personne.email='?', personne.id_auth='?', personne.id_promotion='?' WHERE id='?'";
            $req = $this->db->prepare($sql);
            $d = array($nom,$prenom,$type,$email,$id_auth,$id_promotion,'1');
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
	
	public function delete($id)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'DELETE ' .
                                'FROM personne ' .
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

public function create($nom, $prenom, $email)
        {
                $retour = -1;
                try {
                        $db = new PDO($this->hostname . $this->dbname, $this->username, $this->password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = $db->prepare(
                                'INSERT INTO personne ' .
                                '(nom, prenom, type, email, id_auth, id_promotion) ' .
                                'VALUES (:nom, :prenom, 'professeur', :email, NULL, NULL) '
                        );

                        $query->bindParam(':nom', $nom->get_nom());
                        $query->bindParam(':prenom', $prenom->get_prenom());
                        $query->bindParam(':email', $email->get_email());
                        $query->execute();

                        $retour = $db->lastInsertId();

                } catch (Exception $e) {
                        echo 'Erreur MySQL : ' . $e->getMessage();
                }

                $db = NULL;
                return $retour;
        }






	 
}



