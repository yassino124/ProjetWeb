<?php
    class Reponse
    {
        private $id_reponse;
        private $reponse;
        private $id_reclamation;
        private $date_r;
        private $id_user;

        public function __construct($id_reponse = null, $reponse = null, $id_reclamation = null, $date = null, $id_user = null)
        {
            $this->id_reponse = $id_reponse;
            $this->reponse = $reponse;
            $this->id_reclamation = $id_reclamation;
            $this->date = $date;
            $this->id_user = $id_user;
        }
        static  public function TrouverReponse($data)
        {
                $recherche = $data['recherche'];
                try {
                    $query = 'SELECT * FROM reponse_reclamation WHERE reponse LIKE ?';
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
    public function getId_reponse()
    {
        return $this->id_reponse;
    }

    public function setId_reponse($id_reponse)
    {
        $this->id_reponse = $id_reponse;
        return $this;
    }

    public function getReponse()
    {
        return $this->reponse;
    }

    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
        return $this;
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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }
}
?>