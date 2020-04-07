<?php
                  
      abstract class ChambreManager
    {
    
        abstract protected function add(Chambre $chambre);

        abstract public function count();
        
        abstract public function delete($codeCbr);
        
        abstract public function getList($debut = -1, $limite = -1);
        
        abstract public function getUnique($codeCbr);
        
        abstract public function getDispoList($debut = -1, $limite = -1);

        public function save(Chambre $chambre)
        {
            if($chambre->isValid())
            {
                $chambre->isNew() ? $this->add($chambre) : $this->Update($chambre);
            }
            else
            {
                throw new RuntimeException('La Chambre et ses coordonn��s doit �tre valide pour �tre enr�gistr�e');
            }
        }
    
        abstract protected function update(Chambre $chambre);
    }    

?>