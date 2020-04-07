<?php
		session_start();
			    if (!isset($_SESSION['pseudo']))
			    
          ?>
	  <?php if(($_SESSION['pseudo']=="adodo")){ ?>
<?php
    require 'autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new ReservationManager_PDO($db);


    if (isset ($_GET['modifier']))
        $reservation = $manager->getUnique ((int) $_GET['modifier']);
        
    if (isset ($_GET['supprimer']))
    {
        $manager->delete((int) $_GET['supprimer']);
        $message = 'La réservation a bien été supprimée !';
    }

    if (isset ($_POST['nomRsv']))
    {
        
        $reservation = new Reservation(
        array (//'idCli' => $_POST['idCli'],
                //'codeFct' => $_POST['codeFct'],
                'confRsv' => $_POST['confRsv'],
                'typeCbr' => $_POST['typeCbr'],
                //'dateRsv' => $_POST['dateRsv'],
                'dateDebutRsv' => $_POST['dateDebutRsv'],
                'dateFinRsv' => $_POST['dateFinRsv'],
                'numCbr' => $_POST['numCbr'],
                'nomRsv' => $_POST['nomRsv'],
                'infoRsv' => $_POST['infoRsv'],
                'emailRsv' => $_POST['emailRsv'],
		 'numCarte' => $_POST['numCarte']
             )
    );
    
    
    if (isset($_POST['codeRsv']))
        $reservation->setCodeRsv($_POST['codeRsv']);

    if ($reservation->isValid())
    {
        echo 'ff';
        $manager->savee($reservation);
        $message = $reservation->isNew() ? 'La reservation a bien été ajoutée!' : 'La reservation a bien été modifiée !';
    }
    else
        $erreurs = $reservation->erreurs();
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
<body>
<script src="cal.js"></script>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F7E6D4">
  <tr>
  <td height="80" width="780"><img / src="images/header2.jpg" width="780" height="80"></td>
  </tr>
  <tr>
  <td height="5" width="780" bgcolor="#AA6F47"></td>
  </tr>
  <tr>
    <td valign="top"><table width="780" border="0" cellspacing="0" cellpadding="0">
      <!--<tr>
        <td width="360" height="86" align="right" valign="top" bgcolor="#996138" style="background-image:url(images/index_02.gif); background-repeat:repeat-x; background-position:top;"><a href="index.html"><img src="images/index_04.gif" alt="" width="304" height="80" border="0"/></a></td>
        <td width="420" bgcolor="#996138" style="background-image:url(images/index_02.gif); background-repeat:repeat-x; background-position:top;">&nbsp;</td>
      </tr>
      <tr>-->
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            
            
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:#FFFFFF 2px solid;">
          <tr>
            <td width="11" align="left" valign="top" bgcolor="#EABE94"><img src="images/index_31.gif" width="11" height="38" alt="" /></td>
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="index.php">Acceuil</a>                  <a href="ReservationAdministration.php">R&eacute;servation</a>                        <a href="hotelAdministrateur.php">Chambre</a></pre></td>
            <td width="11" align="right" valign="top" bgcolor="#EABE94"><img src="images/index_34.gif" width="11" height="38" alt="" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:15px; padding-bottom:15px;">
	
	<table width="94%" height="14" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
	
        <td width="67%" valign="top" style="padding-top:30px">
	    <?php if(isset($_SESSION['pseudo'])){ ?>
		Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br />
	    <a href="deconnexion.php">Déconnexion</a>
	    <?php
	    }
	    ?>
        <center><div style="width: 400px; height: 300px; background: #66cccc; border-radius:10px 10px 10px 10px;">  
        <form action="ReservationAdministration.php" method="post" enctype="multipart/form-data" >
           <p style="text-align: center">
            <center><table>
            
            <?php
                if (isset ($message))echo $message, '<br />';
            ?>
            <?php if (isset($erreurs) && in_array(Reservation::NOMRSV_INVALIDE, $erreurs)) echo 'Le nom de réservation est invalide.<br />'; ?>
                <tr>
                    <td>Nom de r&eacute;servation : </td>
                    <td><input type="text" name="nomRsv" value="<?php if (isset($reservation)) echo $reservation->nomRsv(); ?>" /></td>
                </tr>
            <?php if (isset($erreurs) && in_array(Reservation::TYPECBR_INVALIDE, $erreurs)) echo 'Le type de la chambre est invalide.<br />'; ?>
                <tr>
                    <td>Type de chambre : </td>
                    <td><select type="text" name="typeCbr" value="<?php if (isset($reservation)) echo $reservation->typeCbr(); ?>" />
                    <option>Suite minist&eacute;rielle</option>
                    <option>Standard double</option>
                    </select></td>
                </tr>
                        <?php if (isset($erreurs) && in_array(Reservation::DATEDEBUTRSV_INVALIDE, $erreurs)) echo 'La date d\'arrivée est invalide.<br />'; ?>
                <tr>
                    <td>Date d'arriv&eacute;e : </td>
                    <td><input type="text" name="dateDebutRsv" value="<?php if (isset($reservation)) echo $reservation->dateDebutRsv(); ?>" /></td>
                </tr>
                   <?php if (isset($erreurs) && in_array(Reservation::DATEFINRSV_INVALIDE, $erreurs)) echo 'La date de départ est invalide.<br />'; ?>
                <tr>
                    <td>Date départ : </td>
                    <td><input type="text" name="dateFinRsv" value="<?php if (isset($reservation)) echo $reservation->dateFinRsv(); ?>" /></td>
                </tr>
               <?php if (isset($erreurs) && in_array(Reservation::CONFRSV_INVALIDE, $erreurs)) echo 'La confirmation est invalide.<br />'; ?>
                <tr>
                    <td>Confirm&eacute;e :</td>
                    <td><select name="confRsv" value="<?php if (isset($reservation)) echo $reservation->confRsv(); ?>" />
                        <option>OUI</option>
                        <option>NON</option>
                        </select></td>
                </tr>
                 <?php if (isset($erreurs) && in_array(Reservation::EMAILRSV_INVALIDE, $erreurs)) echo 'L\'email est invalide.<br />'; ?>
                <tr>
                    <td>Email : </td>
                    <td><input type="email" name="emailRsv" value="<?php if (isset($reservation)) echo $reservation->emailRsv(); ?>" /></td>
                </tr>
                <?php if (isset($erreurs) && in_array(Reservation::NUMRSV_INVALIDE, $erreurs)) echo 'Le numeros de chambre est invalide.<br />'; ?>
                <tr>
                    <td>Num&eacute;ros de chambre : </td>
                    <td><input name="numCbr" value="<?php if (isset($reservation)) echo $reservation->numCbr(); ?>" /></td>
                </tr>
                 <?php if (isset($erreurs) && in_array(Reservation::INFORSV_INVALIDE, $erreurs)) echo 'L\'information est invalide.<br />'; ?>
                <tr>
                    <td>Autres demandes : </td>
                    <td><textarea name="infoRsv" id="infoRsv"><?php if (isset($reservation)) echo $reservation->infoRsv(); ?></textarea></td>
                </tr>
            </table></center>
            <?php
                if(isset($reservation) && !$reservation->isNew())
            {
                ?>
                <center> <table>
                    <tr>
                        <td><input type="hidden" name="codeRsv" value="<?php echo $reservation->codeRsv(); ?>" />
                <input type="submit" value="Modifier" name="modifier" /></td>
                  <td><a href="ReservationAdministration.php"><img src="images/annuler.gif"> </a></td>
                    </tr>
                </table></center>
            <?php
            }
            else
            {
            ?>
             <center> <table><tr><td><input type="submit" name="ajouter" value="Ajouter" /> </td><td><a href="ReservationAdministration.php"><img src="images/nouveau.gif"/></a></td></tr></table> </center>
            <?php
            }
            ?>
           </p>
           
        </form>
        </div></center>
            <p style="text-align: center">Il y a actuellement <?php echo $manager->count(); ?> demandes de r&eacute;servation. En voici la liste :</p>
            <center><table border=" 3px outset" style="border: medium">
            <tr bgcolor="#b88e64" style="border: medium"><th style="border: medium">Nom de r&eacute;servation</th><th style="border: medium">Type de chambre</th><th style="border: medium">Date d'arriv&eacute;e</th><th style="border: medium">Date de d&eacute;part</th><th style="border: medium">Confirm&eacute;e</th><th style="border: medium">Email</th><th style="border: medium">Numeros de chambre</th><th style="border: medium">Numeros de carte bancaire</th><th style="border: medium">Plus d'information</th><th style="border: medium">Action</th></tr>    
            <?php
                foreach ($manager->getList() as $reservation)echo '<tr style="border: medium; background: #b9dcb0"><td style="border: medium">', $reservation->nomRsv(), '</td><td style="border: medium">', $reservation->typeCbr(), '</td><td style="border: medium">', $reservation->dateDebutRsv(), '</td><td style="border: medium">', $reservation->dateFinRsv(), '</td><td style="border: medium">', $reservation->confRsv(),'</td><td style="border: medium">', $reservation->emailRsv(),'</td><td style="border: medium">', $reservation->numCbr(),'</td><td style="border: medium">', $reservation->numCarte(),'</td><td style="border: medium">', $reservation->infoRsv() ,'</td><td style="border: medium"><a href="?modifier=', $reservation->codeRsv(), '"><img src="images/modifier.gif"/></a></a> | <a href="?supprimer=', $reservation->codeRsv(), '"><img src="images/supprimer.gif"/></a></a></td></tr>', "\n";
?>
      </tr>
    </table></td>
  </tr>
</table>
  <tr>
    <td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="index.html">Accueil</a>     ::    <a href="ReservationAdministration.php">R&eacute;servation</a>     ::     <a href="hotelAdministrateur.php">Chambre</a><br />    Copyright &copy; 2011-2012</pre></td>
  </tr>
       </table>
    </body>
</html>
<?php
	    }
	    else echo"Vous devez etre connecté ";
	    ?>