<?php
		session_start();
			    if (!isset($_SESSION['pseudo']))
			    
          ?>
 <?php if(($_SESSION['pseudo']=="adodo")){ ?>
<?php
    require 'autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new ChambreManager_PDO($db);

    //gestion des images
    if (!empty($_FILES)){
        require("imgClass.php");

        //passer l'image à une variable
        $img = $_FILES['img'];
        //recuperer l'extension en minuscule ds une variable 
        $ext = strtolower(substr($img['name'],-3));
        //permettre des extensions
        $allow_ext = array('jpg','png','gif');
        //controler 
        if(in_array($ext,$allow_ext)){
            //deplacement du fichier
            move_uploaded_file($img['tmp_name'],"images/".$img['name']);
            Img::creerMin("images/".$img['name'],"images/min",$img['name'],215,112);
        }
        else{
            $erreur = "Votre fichier n'est pas une image";
        }
    }

    if (isset ($_GET['modifier']))
        $chambre = $manager->getUnique ((int) $_GET['modifier']);
        
    if (isset ($_GET['supprimer']))
    {
        $manager->delete((int) $_GET['supprimer']);
        $message = 'La chambre a bien été supprimée !';
    }

    if (isset ($_POST['numCbr']))
    {
        $chambre = new Chambre (
        array ('numCbr' => $_POST['numCbr'],
                'telCbr' => $_POST['telCbr'],
                'dispoCbr' => $_POST['dispoCbr'],
                'typeCbr' => $_POST['typeCbr'],
                'prixCbr' => $_POST['prixCbr'],
                'nombrPCbr' => $_POST['nombrPCbr']
             )
    );

    
    
    if (isset($_POST['codeCbr']))
        $chambre->setcodeCbr($_POST['codeCbr']);

    if ($chambre->isValid())
    {
        $manager->save($chambre);
        $message = $chambre->isNew() ? 'La news a bien été ajoutée!' : 'La news a bien été modifiée !';
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
<body>
<script src="cal.js"></script>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F7E6D4">
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
            
        <center><p><h2>Formulaire d'administration de chambre</h2></p></center>    
          
        <form action="hotelAdministrateur.php" method="post" enctype="multipart/form-data" ><fieldset style="">
           <p style="text-align: center" >
            <center><table>
            <?php
                $dos = "images/min";
            $dir = opendir($dos);
              while($file = readdir($dir)){
                  $allow_ext = array('jpg','png','gif');
                   $ext = strtolower(substr($file,-3));
                   if(in_array($ext,$allow_ext)){
                    
                        $y = '<img src="images/min/<?php echo $file; ?>"/>';
                    
                     }
                }
            ?>
            <?php
                if (isset ($message))echo $message, '<br />';
            ?>
            <?php if (isset($erreurs) && in_array(Chambre::NUMCBR_INVALIDE, $erreurs)) echo 'Le numeros de la chambre est invalide.<br />'; ?>
                <tr>
                    <td>Numero : </td>
                    <td><input type="text" name="numCbr" value="<?php if (isset($chambre)) echo $chambre->numCbr(); ?>" /></td>
                </tr>
            <?php if (isset($erreurs) && in_array(Chambre::TELCBR_INVALIDE, $erreurs)) echo 'Le numeros de telephone est invalide.<br />'; ?>
                <tr>
                    <td>Telephone : </td>
                    <td><input type="text" name="telCbr" value="<?php if (isset($chambre)) echo $chambre->telCbr(); ?>" /></td>
                </tr>
            <?php if (isset($erreurs) && in_array(Chambre::DISPOCBR_INVALIDE, $erreurs)) echo 'Le disponibilte est invalide.<br />'; ?>
                <tr>
                    <td>Disponibilite :</td>
                    <td><select name="dispoCbr" value="<?php if (isset($chambre)) echo $chambre->dispoCbr(); ?>" />
                        <option>oui</option>
                        <option>non</option>
                        </select></td>
                </tr>    
            <?php if (isset($erreurs) && in_array(Chambre::TYPECBR_INVALIDE, $erreurs)) echo 'Le type de la chambre est invalide.<br />'; ?>
                <tr>
                    <td>Type de chambre : </td>
                    <td><select type="text" name="typeCbr" value="<?php if (isset($chambre)) echo $chambre->typeCbr(); ?>" />
                    <option>Suite minist&eacute;rielle</option>
                    <option>Standard double</option>
                    </select></td>
                </tr>
            <?php if (isset($erreurs) && in_array(Chambre::PRIXCBR_INVALIDE, $erreurs)) echo 'Le prix de la est invalide.<br />'; ?>
                <tr>
                    <td>Prix de la chambre : </td>
                    <td><input type="text" name="prixCbr" value="<?php if (isset($chambre)) echo $chambre->prixCbr(); ?>" /></td>
                </tr>
            <?php if (isset($erreurs) && in_array(Chambre::NOMBRPCBR_INVALIDE, $erreurs)) echo 'Le nombre de place est invalide.<br />'; ?>
            <?php
                if(isset($erreur)){echo $erreur;}
            ?>
                <tr>
                    <td>Nombre de place : </td>
                    <td><input type="text" name="nombrPCbr" value="<?php if (isset($chambre)) echo $chambre->nombrPCbr(); ?>" /></td>
                </tr>
                <tr>
                    
                    <td>Ajouter l'image de la chambre: </td>
                    <td><input type="file" name="img"/></td>
                </tr>
            </table></center>
            <?php
                if(isset($chambre) && !$chambre->isNew())
            {
                ?>
                <center> <table>
                    <tr>
                        <td><input type="hidden" name="codeCbr" value="<?php echo $chambre->codeCbr(); ?>" />
                <input type="submit" value="Modifier"name="modifier" /></td>
                  <td><a href="hotelAdministrateur.php"><img src="images/annuler.gif"> </a></td>
                    </tr>
                </table></center>
            <?php
            }
            else
            {
            ?>
             <center> <table><tr><td><input type="submit" value="Ajouter" /> </td><td><a href="hotelAdministrateur.php"><img src="images/nouveau.gif"/></a></td></tr></table> </center>
            <?php
            }
            ?>
           </p>
           </fieldset>
        </form>
        
            <p style="text-align: center">Il y a actuellement <?php echo $manager->count(); ?> chambre. En voici la liste :</p>
            <center><table border=1>
            <tr><th>Numeros</th><th>Telephone</th><th>Disponible</th><th>Type de chambre</th><th>Prix de la chambre</th><th>Nombre de place</th><th>Apercu</th><th>Action</th></tr>
            <?php
                foreach ($manager->getList() as $chambre)echo '<tr><td>', $chambre->numCbr(), '</td><td>', $chambre->telCbr(), '</td><td>', $chambre->dispoCbr(), '</td><td>', $chambre->typeCbr(), '</td><td>', $chambre->prixCbr(),'</td><td>', $chambre->nombrPCbr(),'</td><td>   image</td><td><a href="?modifier=', $chambre->codeCbr(), '"><img src="images/modifier.gif"/></a></a> | <a href="?supprimer=', $chambre->codeCbr(), '"><img src="images/supprimer.gif"/></a></a></td></tr>', "\n";

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