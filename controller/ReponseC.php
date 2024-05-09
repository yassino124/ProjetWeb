<?php
include '../../../config.php';
include '../../../Model/Reponse.php';

class ReponseC
{
    public function listReponse()
    {
        $sql = "SELECT * FROM reponse_reclamation";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            throw new Exception('Error fetching reponses: ' . $e->getMessage());
        }
    }

    public function addReponse($reponse)
    {
        $sql = "INSERT INTO reponse_reclamation (id_reponse, reponse, id_reclamation, date_r, id_user) 
                VALUES (:id_reponse, :reponse, :id_reclamation, :date_r, :id_user)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id_reponse' => $reponse->getId_reponse(),
                ':reponse' => $reponse->getReponse(),
                ':id_reclamation' => $reponse->getId_reclamation(),
                ':date_r' => $reponse->getDate(),
                ':id_user' => $reponse->getId_user(),
            ]);
            return $db->lastInsertId(); // Retourne l'ID du nouvel enregistrement
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de l\'ajout de la réponse : ' . $e->getMessage());
        }
    }
    

    public function deleteReponse($id_reponse)
    {
        $sql = "DELETE FROM reponse_reclamation WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_reponse', $id_reponse);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function showReponse($id_reponse)
    {
        $sql = "SELECT * FROM reponse_reclamation WHERE id_reponse = :id_reponse";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_reponse', $id_reponse, PDO::PARAM_INT);
            $query->execute();
            $reponse = $query->fetch();
            return $reponse;
        } catch (PDOException $e) {
            throw new Exception('Error fetching complaint details: ' . $e->getMessage());
        }
    }

    public function updateReponse($id_reponse, $reponse_reclamation)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE reponse_reclamation SET 
                    reponse = :reponse, 
                    id_reclamation = :id_reclamation, 
                    date_r = :date_r,
                    id_user = :id_user,
                WHERE id_reponse = :id_reponse'
            );
            $query->execute([
                'id_reponse' => $id_reponse,
                'reponse' => $reponse_reclamation->getReponse(),
                'id_reclamation' => $reponse_reclamation->getId_reclamation(),
                'date_r' => $reponse_reclamation->getDate(),
                'id_user' => $reponse_reclamation->getId_user(),
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error updating reponse: " . $e->getMessage();
        }
    }

    public function rechercheReponse(){
		if(isset($_POST['recherche'])){
			$data = array('recherche' => $_POST['recherche']);
            
		}
		$reponse = reponse::TrouverReponse($data);
        return $reponse;

	} 
}
?>