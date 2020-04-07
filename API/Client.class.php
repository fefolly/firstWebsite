<?php
    class Client
    {
        protected $erreurs = array(),
                        $idCli,
                        $nomCli,
                        $prenCli,
                        $emailCli,
                        $telCli,
                        $adressCli,
                        $pseudo,
                        $password,
                        $dateNaissCli;
                        
                const NOMCLI_INVALIDE = 1;
                const PRENCLI_INVALIDE = 2;
                const EMAILCLI_INVALIDE = 3;
                const TELCLI_INVALIDE = 4;
                const ADRESSCLI_INVALIDE = 5;
                const PSEUDO_INVALIDE = 6;
                const PASSWORD_INVALIDE = 7;
                const DATENAISSCLI_INVALIDE = 8;
   
   
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
            return empty($this->idCli);
        }
    
        
        public function isValid()
        {
            return !(empty($this->nomCli) || empty($this->prenCli) || empty($this->emailCli) || empty($this->telCli) || empty($this->adressCli) || empty($this->pseudo) || empty($this->password) || empty($this->dateNaissCli));
        }
    
    
        public function setIdCli($idCli)
        {
            $this->idCli = (int) $idCli;
        }
        
        
        public function setNomCli($nomCli)
        {
            if (!is_string($nomCli) || empty($nomCli))
              $this->erreurs[] = self::NOMCLI_INVALIDE;
            else
                $this->nomCli = $nomCli;
        }
        
        
        public function setPrenCli($prenCli)
        {
            if (!is_string($prenCli) || empty($prenCli))
              $this->erreurs[] = self::PRENCLI_INVALIDE;
            else
                $this->prenCli = $prenCli;
        }
        
        
        public function setEmailCli($emailCli)
        {
            if (!is_string($emailCli) || empty($emailCli))
              $this->erreurs[] = self::EMAILCLI_INVALIDE;
            else
                $this->emailCli = $emailCli;
        }
    
        public function setTelCli($telCli)
        {
            if (!is_string($telCli) || empty($telCli))
              $this->erreurs[] = self::TELCLI_INVALIDE;
            else
                $this->telCli = $telCli;
        }
        
        
        public function setAdressCli($adressCli)
        {
            if (!is_string($adressCli) || empty($adressCli))
              $this->erreurs[] = self::ADRESSCLI_INVALIDE;
            else
                $this->adressCli = $adressCli;
        }
        
        
        public function setPseudo($pseudo)
        {
            if (!is_string($pseudo) || empty($pseudo))
              $this->erreurs[] = self::PSEUDO_INVALIDE;
            else
                $this->pseudo = $pseudo;
        }
        
        public function setPasssword($password)
        {
            if (!is_string($password) || empty($password))
              $this->erreurs[] = self::PASSWORD_INVALIDE;
            else
                $this->password = $password;
        }
        
        public function setDatenaisscli($dateNaissCli)
        {
            if (!is_string($dateNaissCli) || empty($dateNaissCli))
              $this->erreurs[] = self::DATENAISSCLI_INVALIDE;
            else
                $this->dateNaissCli = $dateNaissCli;
        }
        
        //getter//
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function idCli()
        {
            return $this->idCli;
        }
        
        public function nomCli()
        {
            return $this->nomCli;
        }
        
        public function prenCli()
        {
            return $this->prenCli;
        }
        
        public function emailCli()
        {
            return $this->emailCli;
        }
        
        public function telCli()
        {
            return $this->telCli;
        }
        
        public function adressCli()
        {
            return $this->adressCli;
        }
        
        public function pseudo()
        {
            return $this->pseudo;
        }  
    
        public function password()
        {
            return $this->password;
        }
        
        public function dateNaissCli()
        {
            return $this->dateNaissCli;
        }
    

    }
?>