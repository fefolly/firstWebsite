<?php

    class ChambreManager_PDO extends ChambreManager
    {

        protected $db;

        public function __construct(PDO $db)
        {
        $this->db = $db;
        }

        protected function add(Chambre $chambre)
        {
            $requete = $this->db->prepare('INSERT INTO chambre SET numCbr = :numCbr, telCbr = :telCbr, dispoCbr = :dispoCbr, typeCbr = :typeCbr, prixCbr = :prixCbr, nombrPCbr = :nombrPCbr');
            $requete->bindValue(':numCbr', $chambre->numCbr());
            $requete->bindValue(':telCbr', $chambre->telCbr());
            $requete->bindValue(':dispoCbr', $chambre->dispoCbr());
            $requete->bindValue(':typeCbr', $chambre->typeCbr());
            $requete->bindValue(':prixCbr', $chambre->prixCbr());
            $requete->bindValue(':nombrPCbr', $chambre->nombrPCbr());
            $requete->execute();
        }

        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM chambre')->fetchColumn();
        }

        public function delete($codeCbr)
        {
            $this->db->exec('DELETE FROM chambre WHERE codeCbr = '.(int) $codeCbr);
        }
        
        
        
        
        public function getList($debut = -1, $limite = -1)
        {
            $listeChambre = array();
            $sql = 'SELECT codeCbr, numCbr, telCbr, dispoCbr, typeCbr, prixCbr, nombrPCbr FROM chambre ORDER BY codeCbr DESC';

                // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }

            $requete = $this->db->query($sql);
            while ($chambre = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeChambre[] = new Chambre($chambre);
            }
            
            $requete->closeCursor();

            return $listeChambre;
        }

        
        public function getUnique($codeCbr)
        {
            $requete = $this->db->prepare('SELECT codeCbr, numCbr, telCbr, dispoCbr, typeCbr, prixCbr, nombrPCbr FROM chambre WHERE codeCbr = :codeCbr');
            $requete->bindValue(':codeCbr', (int) $codeCbr, PDO::PARAM_INT);
            $requete->execute();
            
            return new Chambre($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        
        public function getDispoList($debut = -1, $limite = -1)
        {
            $listeCh = array();
            $sql = 'SELECT codeCbr, typeCbr, prixCbr, nombrPCbr FROM chambre WHERE dispoCbr = "oui"';

                // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }

            $requete = $this->db->query($sql);
            while ($chambre = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $liste[] = new Chambre($chambre);
            }
            
            $requete->closeCursor();

            return $liste;
        }

        protected function update(Chambre $chambre)
        {
            $requete = $this->db->prepare('UPDATE chambre SET numCbr = :numCbr, telCbr = :telCbr, dispoCbr = :dispoCbr, typeCbr = :typeCbr, prixCbr = :prixCbr, nombrPCbr = :nombrPCbr WHERE codeCbr = :codeCbr');
            $requete->bindValue(':numCbr', $chambre->numCbr());
            $requete->bindValue(':telCbr', $chambre->telCbr());
            $requete->bindValue(':dispoCbr', $chambre->dispoCbr());
            $requete->bindValue(':typeCbr', $chambre->typeCbr());
            $requete->bindValue(':prixCbr', $chambre->prixCbr());
            $requete->bindValue(':nombrPCbr', $chambre->nombrPCbr());
            $requete->bindValue(':codeCbr', $chambre->codeCbr(), PDO::PARAM_INT);
            $requete->execute();
        }
    }
?>