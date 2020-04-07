<?php

    class ClientManager_PDO extends ClientManager
    {

        protected $db;

        public function __construct(PDO $db)
        {
        $this->db = $db;
        }

        protected function add(Client $client)
        {
            $requete = $this->db->prepare('INSERT INTO client SET nomCli = :nomCli, prenCli = :prenCli, emailCli = :emailCli, telCli = :telCli, adressCli = :adressCli, pseudo = :pseudo, password = :password, dateNaissCli = :dateNaissCli');
            $requete->bindValue(':nomCli', $client->nomCli());
            $requete->bindValue(':prenCli', $client->prenCli());
            $requete->bindValue(':emailCli', $client->emailCli());
            $requete->bindValue(':telCli', $client->telCli());
            $requete->bindValue(':adressCli', $client->adressCli());
            $requete->bindValue(':pseudo', $client->pseudo());
            $requete->bindValue(':password', $client->password());
            $requete->bindValue(':dateNaissCli', $client->dateNaissCli());
            $requete->execute();
        }

        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM client')->fetchColumn();
        }

        public function delete($idCli)
        {
            $this->db->exec('DELETE FROM client WHERE idCli = '.(int) $idCli);
        }
        
        
      /*  abstract public function rechExiste($pseudo)
        {
            $this->db->query('SELECT COUNT(*) FROM client WHERE pseudo = '.$pseudo)->fetchColumn();
        }*/
        
        public function getList($debut = -1, $limite = -1)
        {
            $listeClient = array();
            $sql = 'SELECT idCli, nomCli, prenCli, emailCli, telCli, adressCli, pseudo, password, dateNaissCli FROM client ORDER BY idCli DESC';

                // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }

            $requete = $this->db->query($sql);
            while ($client = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeClient[] = new Client($client);
            }
            
            $requete->closeCursor();

            return $listeClient;
        }

        
        public function getUnique($idCli)
        {
            $requete = $this->db->prepare('SELECT idCli, nomCli, prenCli, emailCli, telCli, adressCli, pseudo, password, dateNaissCli FROM chambre WHERE idCli = :idCli');
            $requete->bindValue(':idCli', (int) $idCli, PDO::PARAM_INT);
            $requete->execute();
            
            return new Client($requete->fetch(PDO::FETCH_ASSOC));
        }


        protected function update(Client $client)
        {
            $requete = $this->db->prepare('UPDATE chambre SET numCbr = :numCbr, telCbr = :telCbr, dispoCbr = :dispoCbr, typeCbr = :typeCbr, prixCbr = :prixCbr, nombrPCbr = :nombrPCbr WHERE codeCbr = :codeCbr');
            $requete->bindValue(':nomCli', $client->nomCli());
            $requete->bindValue(':prenCli', $client->prenCli());
            $requete->bindValue(':emailCli', $client->emailCli());
            $requete->bindValue(':telCli', $client->telCli());
            $requete->bindValue(':adressCli', $client->adressCli());
            $requete->bindValue(':pseudo', $client->pseudo());
            $requete->bindValue(':password', $client->password());
            $requete->bindValue(':idCli', $client->idCli(), PDO::PARAM_INT);
            $requete->execute();
        }
    }
?>