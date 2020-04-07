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
        $chambre = $manager->getUniqueR ((int) $_GET['modifier']);
          
          
    if (isset($_POST['codeCbr']))
        $chambre->setcodeCbr($_POST['codeCbr']);
        
        //j'aurais besoin de isReserve
    if ($reservation->isValidR())
    {
        $gestion->saveR($reservation);
        $message = $reservation->isNew() ? 'La reservation a bien été effectuée!' : 'La reservation a bien été modifiée !';
    }
    else
        $erreurs = $chambre->erreurs();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
<title>Hôtel Eda Oba</title>
<link href="css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="cal.css" media="screen" />

    
</head>
<body >

<table width="780" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F7E6D4" border="solid">
  
  
  <tr>
  <td height="80" width="780"><img / src="images/header2.jpg" width="780" height="80"></td>
  </tr>
  
  <tr>
      <td>
        
         <h3>Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br /></h3>
	    <h5><a href="index.php">Déconnexion</a></h5>
    
    <script src="cal.js"></script>
    <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
      
          <tr>
            <td width="400" valign="top"><?php include_once('galerieCbr.html');?></td>
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
					<input type="text" style="cursor: pointer" size="10" onclick="new calendar(this);" value=" " id="dateDebut" />
                  </label></td>
                  <td align="left" align="top"><label>
                    <input type="text" style="cursor: pointer" size="10" onclick="new calendar(this);" value=" " id="dateFin" />
                  </label></td>
                </tr>
                <tr>
                  <td colspan="2" align="left" valign="top" style="padding-bottom:10px; padding-top:10px;">
				  <table width="100%" >
                    <tr>
                      <td width="50%" align="left" valign="top" >Type de chambres</td>
                      <td width="50%" align="left" valign="top" >Nombre d'occupants</td>
					 
                    </tr>
                    <tr>
                       <td><label>
                        <select name="select4">
							<option>Suite Minist&eacute;rielle</option>
							<option>Standard double</option>
                        </select>
                      </label></td>
                      <td><label>
                        <select name="select5">
							<option>01</option>
							<option>02</option>
							<option>03</option>
  
                        </select>
                      </label></td>
				
                    </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td align="left" valign="top"><label>
                    <center><input type="submit" name="lui" value="V&eacute;rifier disponibilt&eacute;"/></center>
                  </label></td>
                </tr>
              </table>
                        </form></div>			</td>
          </tr>
          
        </table>
     </td>
      </tr>
  
      <tr>
      <td>
         <table>
           <tr>
            <td width="11" align="left" valign="top" bgcolor="#EABE94"><img src="images/index_31.gif" width="11" height="38" alt="" /></td>
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="reserv.php">Acceuil</a>                <a href="eReserv.php">R&eacute;servation</a>                 <a href="">Paiement</a></pre></td>
            <td width="11" align="right" valign="top" bgcolor="#EABE94"><img src="images/index_34.gif" width="11" height="38" alt="" /></td>
          </tr>
           </table>
    <center>
        <?php if(isset($_POST[lui])) echo'<center><p><h3>Liste des chambres disponibles pr&eacute;sentement</h3></p></center>'; "\n"; ?>
    
   <?php if(isset($_POST[lui])) echo'  <table border=1>'; "\n"; ?>
           <?php if(isset($_POST[lui])) echo' <tr><th>Type de chambre</th><th>Prix de la chambre</th><th>Nombre de place</th><th>Action</th></tr>'; "\n"; ?>
            <?php if(isset($_POST[lui]))
                foreach ($manager->getDispoList() as $chambre)echo '<tr><td>', $chambre->typeCbr(), '</td><td>', $chambre->prixCbr(),'</td><td>', $chambre->nombrPCbr(),'</td><td><a href="?reserver=', $chambre->codeCbr(), '"><a href="eReserv.php?identifiant=10">Reserver</a></a></td></tr>', "\n";

?>
           
          <?php  echo'</table>'; "\n"; ?>
   </center>
        
     </td>
      </tr>
    
  <tr>
    <td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="reserv.php">Accueil</a>     ::     <a href="API/eReserv.php">R&eacute;servation</a>     <a href="">Paiement</a><br />    Copyright &copy; 2011-2012 </pre></td>
  </tr>
  
</table>
</body>
</html>