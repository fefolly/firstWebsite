<?php

    class ReservationManager_PDO extends ReservationManager
    {
        protected $db;
        
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        
        protected function add(Reservation $reservation)
        {
            $requete = $this->db->prepare('INSERT INTO reservation SET idCli = :idCli, confRsv = "NON", typeCbr = :typeCbr, dateRsv = NOW(), dateDebutRsv = :dateDebutRsv, dateFinRsv = :dateFinRsv, nomRsv = :nomRsv, infoRsv = :infoRsv, emailRsv=:emailRsv, numCarte=:numCarte');
            
            $requete->bindValue(':idCli', $reservation->idCli());
            //$requete->bindValue(':codeFct', $reservation->codeFct());
            //$requete->bindValue(':confRsv', $reservation->confRsv());
            $requete->bindValue(':typeCbr', $reservation->typeCbr());
            $requete->bindValue(':dateDebutRsv', $reservation->dateDebutRsv());
            $requete->bindValue(':dateFinRsv', $reservation->dateFinRsv());
            $requete->bindValue(':nomRsv', $reservation->nomRsv());
            $requete->bindValue(':infoRsv', $reservation->infoRsv());
            $requete->bindValue(':emailRsv', $reservation->emailRsv());
            $requete->bindValue(':numCarte', $reservation->numCarte());
            
            $requete->execute();
            
        }
        
        
        protected function addd(Reservation $reservation)
        {
            $requete = $this->db->prepare('INSERT INTO reservation SET confRsv = :confRsv, typeCbr = :typeCbr, dateDebutRsv = :dateDebutRsv, dateFinRsv = :dateFinRsv, numCbr = :numCbr, nomRsv = :nomRsv, infoRsv = :infoRsv, emailRsv= :emailRsv, numCarte= :numCarte');
            
           // $requete->bindValue(':idCli', $reservation->idCli());
            //$requete->bindValue(':codeFct', $reservation->codeFct());
            $requete->bindValue(':confRsv', $reservation->confRsv());
            $requete->bindValue(':typeCbr', $reservation->typeCbr());
            $requete->bindValue(':dateDebutRsv', $reservation->dateDebutRsv());
            $requete->bindValue(':dateFinRsv', $reservation->dateFinRsv());
            $requete->bindValue(':numCbr', $reservation->numCbr());
            $requete->bindValue(':nomRsv', $reservation->nomRsv());
            $requete->bindValue(':infoRsv', $reservation->infoRsv());
            $requete->bindValue(':emailRsv', $reservation->emailRsv());
            $requete->bindValue(':numCarte', $reservation->numCarte());
            
            $requete->execute();
            
        }
        
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM reservation')->fetchColumn();
        }
        
      //  public function countDispo($type,$datea,$dateb)
        //{
           // return $this->db->query('SELECT COUNT(*) FROM reservation WHERE typeCbr = '$type' AND dateDebutRsv BETWEEN '$datea' AND '$dateb' AND dateFinRsv BETWEEN '$datea' AND '$dateb)->fetchColumn();
        //}
        
        public function delete($codeRsv)
        {
            $this->db->exec('DELETE FROM reservation WHERE codeRsv = '.(int) $codeRsv);
        }
        
        public function getList($debut = -1, $limite = -1)
        {
            $listeReservation = array();
            
            $sql = 'SELECT codeRsv, idCli, codeFct, confRsv, typeCbr, dateRsv, dateDebutRsv, dateFinRsv, numCbr, nomRsv, infoRsv, emailRsv, numCarte FROM reservation ORDER BY codeRsv DESC';
            
            //on verifie l'integrité des parametres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql =' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            while ($reservation = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeReservation[] = new Reservation($reservation);
            }
            
            $requete->closeCursor();
            
            return $listeReservation;
            
        }
        
        public function getUnique($codeRsv)
        {
            $requete = $this->db->prepare('SELECT codeRsv, idCli, codeFct, confRsv, typeCbr, dateRsv, dateDebutRsv, dateFinRsv, numCbr, nomRsv, infoRsv, emailRsv, numCarte FROM reservation WHERE codeRsv = :codeRsv');
            $requete->bindValue(':codeRsv', (int) $codeRsv, PDO::PARAM_INT);
            $requete->execute();
            
            return new Reservation($requete->fetch(PDO::FETCH_ASSOC));
        }
        
       protected function update(Reservation $reservation)
        {
            $requete = $this->db->prepare('UPDATE reservation SET confRsv = :confRsv, typeCbr = :typeCbr, dateDebutRsv = :dateDebutRsv, dateFinRsv = :dateFinRsv, numCbr = :numCbr, nomRsv = :nomRsv, infoRsv = :infoRsv, emailRsv= :emailRsv, numCarte =: numCarte WHERE codeRsv = :codeRsv');
            //$requete->bindValue(':idCli', $reservation->idCli());
            //$requete->bindValue(':codeFct', $reservation->codeFct());
          $requete->bindValue(':confRsv', $reservation->confRsv());
            $requete->bindValue(':typeCbr', $reservation->typeCbr());
            $requete->bindValue(':dateDebutRsv', $reservation->dateDebutRsv());
            $requete->bindValue(':dateFinRsv', $reservation->dateFinRsv());
            $requete->bindValue(':numCbr', $reservation->numCbr());
            $requete->bindValue(':nomRsv', $reservation->nomRsv());
            $requete->bindValue(':infoRsv', $reservation->infoRsv());
            $requete->bindValue(':emailRsv', $reservation->emailRsv());
            $requete->bindValue(':numCarte', $reservation->numCarte());
            $requete->bindValue(':codeRsv', $reservation->codeRsv(), PDO::PARAM_INT);
            $requete->execute();
        }
        
    
    }

?>