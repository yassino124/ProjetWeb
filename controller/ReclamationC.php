<?php
include '../../../model/Reclamation.php';
include '../../../config.php';

class ReclamationC
{

    public function listReclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            throw new Exception('Error fetching reclamations: ' . $e->getMessage());
        }
    }

    public function addReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation (id_reclamation, nom, email, etat, date_r, tel, commentaire) VALUES (:id_reclamation, :nom, :email, :etat, :date_r, :tel, :commentaire)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id_reclamation' => $reclamation->getId_reclamation(),
                ':nom' => $reclamation->getNom(),
                ':email' => $reclamation->getEmail(),
                ':etat' => $reclamation->getEtat(),
                ':date_r' => $reclamation->getDate(),
                ':tel' => $reclamation->getTel(),
                ':commentaire' => $reclamation->getCommentaire()
            ]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception('Error adding reclamation: ' . $e->getMessage());
        }
    }

    function deleteReclamation($id_reclamation)
    {
        $sql = "DELETE FROM reclamation WHERE id_reclamation = :id_reclamation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_reclamation', $id_reclamation);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function showReclamation($id_reclamation)
    {
        $sql = "SELECT * FROM reclamation WHERE id_reclamation = :id_reclamation";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_reclamation', $id_reclamation, PDO::PARAM_INT);
            $query->execute();
            $reclamation = $query->fetch();
            return $reclamation;
        } catch (PDOException $e) {
            throw new Exception('Error fetching complaint details: ' . $e->getMessage());
        }
    }
    
    public function updateReclamation($id_reclamation, $reclamation)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE reclamation SET 
                    nom = :nom, 
                    email = :email, 
                    etat = :etat,
                    date_r = :date_r,
                    tel = :tel,
                    commentaire = :commentaire
                WHERE id_reclamation = :id_reclamation'
            );
            $query->execute([
                'id_reclamation' => $id_reclamation,
                'nom' => $reclamation->getNom(),
                'email' => $reclamation->getEmail(),
                'etat' => $reclamation->getEtat(),
                'date_r' => $reclamation->getDate(),
                'tel' => $reclamation->getTel(),
                'commentaire' => $reclamation->getCommentaire(),
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error updating reclamation: " . $e->getMessage();
        }
    }

    public function listReclamationTriée($sort_by, $order) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("SELECT * FROM reclamation ORDER BY $sort_by $order");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la récupération des réclamations triées : ' . $e->getMessage());
        }
    }

    public function countNewReclamations() {
        // Requête SQL pour compter les réclamations avec l'état "nouveau"
        $query = "SELECT COUNT(*) FROM reclamation WHERE var_dump = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        // Récupérer le nombre de nouvelles réclamations
        $count = $stmt->fetchColumn();

        return $count;
    }

    public function rechercheReclamationParNom(){
		if(isset($_POST['recherche'])){
			$data = array('recherche' => $_POST['recherche']);
            
		}
		$reclamation = reclamation::TrouverReclamation($data);
        return $reclamation;

	} 

}
?>


