          
<?php
    require 'autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new ReservationManager_PDO($db);
    
    ?>
