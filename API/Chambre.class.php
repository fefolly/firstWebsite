<?php
    class Chambre
    {
        protected $erreurs = array(),
                        $codeCbr,
                        $numCbr,
                        $telCbr,
                        $dispoCbr,
                        $typeCbr,
                        $prixCbr,
                        $nombrPCbr;
                        
                const NUMCBR_INVALIDE = 1;
                const TELCBR_INVALIDE = 2;
                const DISPOCBR_INVALIDE = 3;
                const TYPECBR_INVALIDE = 4;
                const PRIXCBR_INVALIDE = 5;
                const NOMBRPCBR_INVALIDE = 6; 

   
        public function __construct($valeurs = array())
        {
            if (!empty($valeurs)) // Si on a spécifié des valeurs,alors on hydrate l'objet
            $this->hydrate($valeurs);
        }
   
   
        public function hydrate($donnees)
        {
            foreach ($donnees as $attribut => $valeur)
            {
                $methode = 'set'.ucfirst($attribut);
                if (is_callable(array($this, $methode)))
                {
                    $this->$methode($valeur);
                }
            }
        }
        
        public function isNew()
        {
            return empty($this->codeCbr);
        }
   
        public function isValid()
        {
            return !(empty($this->numCbr) || empty($this->telCbr) || empty($this->dispoCbr) || empty($this->typeCbr) || empty($this->prixCbr) || empty($this->nombrPCbr));
        }
    
        public function setCodeCbr($codeCbr)
        {
            $this->codeCbr = (int) $codeCbr;
        }
        
        public function setNumCbr($numCbr)
        {
            if (!is_string($numCbr) || empty($numCbr))
              $this->erreurs[] = self::NUMCBR_INVALIDE;
            else
                $this->numCbr = $numCbr;
        }
        
        public function setTelCbr($telCbr)
        {
            if (!is_string($telCbr) || empty($telCbr))
              $this->erreurs[] = self::NUMCBR_INVALIDE;
            else
                $this->telCbr = $telCbr;
        }
        
        public function setDispoCbr($dispoCbr)
        {
            if (!is_string($dispoCbr) || empty($dispoCbr))
              $this->erreurs[] = self::DISPOCBR_INVALIDE;
            else
                $this->dispoCbr = $dispoCbr;
        }
    
        public function setTypeCbr($typeCbr)
        {
            if (!is_string($typeCbr) || empty($typeCbr))
              $this->erreurs[] = self::TYPECBR_INVALIDE;
            else
                $this->typeCbr = $typeCbr;
        }
        
        public function setPrixCbr($prixCbr)
        {
            if (!is_string($prixCbr) || empty($prixCbr))
              $this->erreurs[] = self::TYPECBR_INVALIDE;
            else
                $this->prixCbr = $prixCbr;
        }
        
        public function setNombrPCbr($nombrPCbr)
        {
            if (!is_string($nombrPCbr) || empty($nombrPCbr))
              $this->erreurs[] = self::NOMBRPCBR_INVALIDE;
            else
                $this->nombrPCbr = $nombrPCbr;
        }
        
       
        
        //getter//
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function codeCbr()
        {
            return $this->codeCbr;
        }
        
        public function numCbr()
        {
            return $this->numCbr;
        }
        
        public function telCbr()
        {
            return $this->telCbr;
        }
        
        public function dispoCbr()
        {
            return $this->dispoCbr;
        }
        
        public function typeCbr()
        {
            return $this->typeCbr;
        }
        
        public function prixCbr()
        {
            return $this->prixCbr;
        }
        
        public function nombrPCbr()
        {
            return $this->nombrPCbr;
        }  
    
       
    }
?>