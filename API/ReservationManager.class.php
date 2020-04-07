<?php
                  
      abstract class ReservationManager
    {
    
        abstract protected function add(Reservation $reservation);

        abstract public function count();
        
       // abstract public function countDispo($type,$datea,$dateb);
        
        abstract public function delete($codeRsv);
        
        abstract public function getList($debut = -1, $limite = -1);
        
        abstract public function getUnique($codeRsv);

        public function save(Reservation $reservation)
        {
            if($reservation->isValid())
            {
                $reservation->isNew() ? $this->add($reservation) : $this->Update($reservation);
            }
            else
            {
                throw new RuntimeException('La reservation et ses suppl�ments doivent �tre valide pour �tre enr�gistr�e');
            }
        }
    
        public function savee(Reservation $reservation)
        {
            if($reservation->isValid())
            {
                $reservation->isNew() ? $this->addd($reservation) : $this->update($reservation);
            }
            else
            {
                throw new RuntimeException('La reservation et ses suppl�ments doivent �tre valide pour �tre enr�gistr�e');
            }
        }
        abstract protected function update(Reservation $reservation);
  
    }    

?>