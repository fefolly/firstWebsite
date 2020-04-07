<?php
		session_start();
			    if (!isset($_SESSION['pseudo']))
			    
			        
          ?>

<?php
    require 'autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new ChambreManager_PDO($db);
   

    if (isset ($_POST['numCbr']))
    {
        $chambre = new Chambre (
        array ('numCbr' => $_POST['numCbr'],
                'telCbr' => $_POST['telCbr'],
                'dispoCbr' => $_POST['dispoCbr'],
                'typeCbr' => $_POST['typeCbr'],
                'prixCbr' => $_POST['prixCbr'],
                'nombrPCbr' => $_POST['nombrPCbr'],
                'imgCbr' => $_POST['imgCbr']
              )
    );
        
  

    
    if (isset ($_GET['modifier']))
        $chambre = $manager->getUnique ((int) $_GET['modifier']);
          
          
    if (isset($_POST['codeCbr']))
        $chambre->setcodeCbr($_POST['codeCbr']);
        
        //j'aurais besoin de isReserve
    if ($reservation->isValid())
    {
        $gestion->save($reservation);
        $message = $reservation->isNew() ? 'La reservation a bien été effectuée!' : 'La reservation a bien été modifiée !';
    }
    else
        $erreurs = $chambre->erreurs();
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>Recherche de chambre ou de salle</title>
        <meta http-equiv="Content-type" content="text/html; charset=iso_8859-1" />
        <link rel="stylesheet" href="cal.css" media="screen" />
    </head>
    <p>
        
      <center>  <h1>Recherchez les chambres disponibles</h1></center>
    <p>

   <body>
    <h3>Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br /></h3>
	    <h5><a href="index.php">Déconnexion</a></h5>
    
    <script src="cal.js"></script>
    <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="419" valign="top"><img src="images/index_20.gif" width="419" height="250" alt="" /></td>
            <td width="311" align="center" valign="top" bgcolor="#5C3317" class="style4">
			<div style="padding-top:25px; padding-bottom:12px;"><img src="images/reserv.gif" width="253" height="29" alt="" /></div>
			<div style="padding-left:5px;"><form id="form1" name="form1" method="post" action="" style="margin:auto;">
              <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
                <tr>
                  <td width="50%" align="left" valign="top">Arriv&eacute;e</td>
                  <td width="50%" align="left" valign="top" class="body2">D&eacute;pard</td>
                </tr>
                <tr>
                  <td align="left" valign="top" ><label>
					<input type="text" style="cursor: pointer" size="10" onclick="new calendar(this);" value="Du :" id="dateDebut" />
                  </label></td>
                  <td align="left" align="top"><label>
                    <input type="text" style="cursor: pointer" size="10" onclick="new calendar(this);" value="Au :" id="dateFin" />
                  </label></td>
                </tr>
                <tr>
                  <td colspan="2" align="left" valign="top" style="padding-bottom:10px; padding-top:10px;">
				  <table width="100%" >
                    <tr>
                      <td width="50%" align="left" valign="top" >Nombre d'occupant</td>
					 
                    </tr>
                    <tr>
                      <td><label>
                        <select name="select5">
							<option>01</option>
							<option>02</option>
							<option>03</option>
							<option>04</option>
							<option>05</option>
							<option>06</option>
							<option>07</option>
							<option>08</option>
							<option>09</option>
							<option>10</option>
                        </select>
                      </label></td>
				
                    </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td align="left" valign="top"><label>
                    <center><input type="submit" value="Verifier disponibilit&eacute;"/></center>
                  </label></td>
                </tr>
              </table>
                        </form></div>			</td>
          </tr>
          
        </table>
    
        <center><p><h3>Liste des chambres disponibles Pr&eacute;sentement</h3></p>
    
    <table border=1>
            <tr><th>Type de chambre</th><th>Prix de la chambre</th><th>Nombre de place</th><th>Image</th><th>Action</th></tr>
            <?php
                foreach ($manager->getDispoList() as $chambre)echo '<tr><td>', $chambre->typeCbr(), '</td><td>', $chambre->prixCbr(),'</td><td>', $chambre->nombrPCbr(),'</td><td>',fff,'</td><td><a href="?reserver=', $chambre->codeCbr(), '"><a href="eReserv.php">Reserver</a></a></td></tr>', "\n";

?>
           
            </table>
    </center>
   </body>
</html>
   