<?php
    class Reservation
    {
        protected $erreurs = array(),
                        $codeRsv,
                        $idCli,
                        $codeFct,
                        $confRsv,
                        $typeCbr,
                        $dateRsv,
                        $dateDebutRsv,
                        $dateFinRsv,
                        $numCbr,
                        $nomRsv,
                        $infoRsv,
                        $emailRsv,
                        $numCarte;
                        
                const IDCLI_INVALIDE = 1;
                const CODEFCT_INVALIDE = 2;
                const CONFRSV_INVALIDE = 3;
                const TYPECBR_INVALIDE = 4;
                const DATERSV_INVALIDE = 5;
                const DATEDEBUTRSV_INVALIDE = 6;
                const DATEFINRSV_INVALIDE = 7;
                const NUMCBR_INVALIDE = 8;
                const NOMRSV_INVALIDE = 9;
                const INFORSV_INVALIDE = 10;
                const EMAILRSV_INVALIDE  = 11;
                const NUMCARTE_INVALIDE = 12;
   
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
            return empty($this->codeRsv);
        }
        
        public function isValid()
        {
            return !(empty($this->nomRsv) || empty($this->infoRsv) || empty($this->emailRsv));
        }   
    
        public function setCodeRsv($codeRsv)
        {
            $this->codeRsv = (int) $codeRsv;
        }
        
        public function setIdCli($idCli)
        {
            if (!is_string($idCli) || empty($idCli))
              $this->erreurs[] = self::IDCLI_INVALIDE;
            else
                $this->idCli = (int)$idCli;
        }
        
        public function setCodeFct($codeFct)
        {
            if (!is_string($codeFct) || empty($codeFct))
              $this->erreurs[] = self::CODEFCT_INVALIDE;
            else
                $this->codeFct = (int)$codeFct;
        }
        
        public function setConfRsv($confRsv)
        {
            if (!is_string($confRsv) || empty($confRsv))
              $this->erreurs[] = self::CONFRSV_INVALIDE;
            else
                $this->confRsv = $confRsv;
        }
        
        public function setTypeCbr($typeCbr)
        {
            if (!is_string($typeCbr) || empty($typeCbr))
              $this->erreurs[] = self::TYPECBR_INVALIDE;
            else
                $this->typeCbr = $typeCbr;
        }
        
        public function setDateRsv($dateRsv)
        {
            if (!is_string($dateRsv) || empty($dateRsv))
              $this->erreurs[] = self::DATERSV_INVALIDE;
            else
                $this->dateRsv = $dateRsv;
        }
    
        public function setDateDebutRsv($dateDebutRsv)
        {
            if (!is_string($dateDebutRsv) || empty($dateDebutRsv))
              $this->erreurs[] = self::DATEDEBUTRSV_INVALIDE;
            else
                $this->dateDebutRsv = $dateDebutRsv;
        }
        
        
        public function setDateFinRsv($dateFinRsv)
        {
            if (!is_string($dateFinRsv) || empty($dateFinRsv))
              $this->erreurs[] = self::DATEFINRSV_INVALIDE;
            else
                $this->dateFinRsv = $dateFinRsv;
        }
        
        public function setNumCbr($numCbr)
        {
            if (!is_string($numCbr) || empty($numCbr))
              $this->erreurs[] = self::NUMCBR_INVALIDE;
            else
                $this->numCbr = (int)$numCbr;
        }
        
        public function setNomRsv($nomRsv)
        {
            if (!is_string($nomRsv) || empty($nomRsv))
              $this->erreurs[] = self::NOMRSV_INVALIDE;
            else
                $this->nomRsv = $nomRsv;
        }
        
        public function setInfoRsv($infoRsv)
        {
            if (!is_string($infoRsv) || empty($infoRsv))
              $this->erreurs[] = self::INFORSV_INVALIDE;
            else
                $this->infoRsv = $infoRsv;
        }
        
        public function setEmailRsv($emailRsv)
        {
            if (!is_string($emailRsv) || empty($emailRsv))
              $this->erreurs[] = self::EMAILRSV_INVALIDE;
            else
                $this->emailRsv = $emailRsv;
        }
        
        
        public function setNumCarte($numCarte)
        {
            if (!is_string($numCarte) || empty($numCarte))
              $this->erreurs[] = self::NUMCARTE_INVALIDE;
            else
                $this->numCarte = (int)$numCarte;
        }
        //getter//
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function codeRsv()
        {
            return $this->codeRsv;
        }
        
        public function idCli()
        {
            return $this->idCli;
        }
        
        public function codeFct()
        {
            return $this->codeFct;
        }
        
        public function confRsv()
        {
            return $this->confRsv;
        }
        
        public function typeCbr()
        {
            return $this->typeCbr;
        }
        
        public function dateRsv()
        {
            return $this->dateRsv;
        }
        
        public function dateDebutRsv()
        {
            return $this->dateDebutRsv;
        }
        
        public function dateFinRsv()
        {
            return $this->dateFinRsv;
        }  
    
        public function numCbr()
        {
            return $this->numCbr;
        }
        
        public function nomRsv()
        {
            return $this->nomRsv;
        }
        
        public function infoRsv()
        {
            return $this->infoRsv;
        }
        
        public function emailRsv()
        {
            return $this->emailRsv;
        }
        
       public function numCarte()
        {
            return $this->numCarte;
        }
        
    }
?>