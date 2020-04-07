<?php
                  
      abstract class ClientManager
    {
    
        abstract protected function add(Client $client);

        abstract public function count();
        
        abstract public function delete($client);
        
        abstract public function rechExiste($client);
        
        abstract public function getList($debut = -1, $limite = -1);
        
        abstract public function getUnique($client);

        public function save(Client $client)
        {
            if($client->isValid())
            {
                $client->isNew() ? $this->add($client) : $this->Update($client);
            }
            else
            {
                throw new RuntimeException('Le Client et ses adresses doivent �tre valide pour �tre enr�gistr�e');
            }
        }
    
        abstract protected function update(Client $client);
  
    }    

?>