<?php

class Reclamation 

{
    private $id_Reclamation;
    private $nom;
    private $email;
    private $etat;
    private $date;
    private $tel;
    private $commentaire;

    public function __construct($id_reclamation = null, $nom = null, $email = null, $etat = null, $date = null, $tel = null, $commentaire = null)
    {
        $this->id_reclamation = $id_reclamation;
        $this->nom = $nom;
        $this->email = $email;
        $this->etat = $etat;
        $this->date = $date;
        $this->tel = $tel;
        $this->commentaire = $commentaire;
    }
    static  public function TrouverReclamation($data)
{
        $recherche = $data['recherche'];
        try {
            $query = 'SELECT * FROM reclamation WHERE nom LIKE ?';
            $stmt = config::getConnexion()->prepare($query);
            $stmt->execute(array('%' .$recherche. '%'));
           $pR= $stmt->fetchAll(PDO::FETCH_ASSOC);     
            return $pR;
            $stmt->close();
            $stmt = null;
        } catch (PDOException $ex) {
            echo 'erreur' . $ex->getMessage();
       
        }
    
}
    public function getId_reclamation()
    {
        return $this->id_reclamation;
    }

    public function setId_reclamation($id_reclamation)
    {
        $this->id_reclamation = $id_reclamation;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }

}
?>
