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
          
          
        </table></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:#FFFFFF 2px solid;">
          <tr>
            <td width="11" align="left" valign="top" bgcolor="#EABE94"><img src="images/index_31.gif" width="11" height="38" alt="" /></td>
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="index.php">Acceuil</a>                <a href="reserv.php">r&eacute;servation</a>                 <a href="contact.php">Vos informations</a></pre></td>
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
        <td width="67%" valign="top">

	  <center><p><h1>Ici, faites vos r&eacute;servations  </h1></p></center>
<table border="3px outset" align="center" >
          <tr>
            <td valign="top" class="body" style="padding-bottom:10px;">
			
			
			
			
<?php
	  function formatJjmmaaaaTOaaaammjj($d){
	      $d2=substr($d,4,4).'-'.substr($d,2,2).'-'.substr($d,0,2);
	      return $d2;
    }

?>

<?php
if (isset($_POST['reserver'])){
    $timeD = " 00:00:00";
    $timeF = " 23:59:59";
    /*$D= addslashes($_POST['dateD']);
    $F= addslashes($_POST['dateF']);
    $dateD=$D.$timeD;
    $dateF=$F.$timeF;*/
    
    $D = addslashes($_POST['dateDebutRsv']);
    $F= addslashes($_POST['dateFinRsv']);
   // $PMEPhone= addslashes($_POST['PMEPhone']);
   // $PMEId= addslashes($_POST['PMEId']);
   // $solde= addslashes($_POST['solde']);
    
    $datexD=explode("/",$D);
    $datexF=explode("/",$F);
   // var_dump($datex);
    $jrD=$datexD[0];
    $moisD=$datexD[1];
    $anneD=$datexD[2];
    
    //var_dump($datex);
   // $jrF=$datexF[0];
   // $moisF=$datexF[1];
   // $anneF=$datexF[2];
    
    if(strlen($jrD)==1)$jrD='0'.$jrD;
    if(strlen($moisD)==1)$moisD='0'.$moisD;
    
   // if(strlen($jrF)==1)$jrF='0'.$jrF;
   // if(strlen($moisF)==1)$moisF='0'.$moisF;
    //if(strlen($anne)==1)$anne='0'.$anne;
    $D =$jrD.$moisD.$anneD;
    $F =$jrF.$moisF.$anneF;
    
    
    $dateD=formatJjmmaaaaTOaaaammjj($D).$timeD;
    $dateF=formatJjmmaaaaTOaaaammjj($F).$timeF;
    }
?>			
 <?php
	if(isset($_POST['reserver']) && $_POST['reserver'] == 'Reserver'){
			
			// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
			
			 if ((isset($_POST['typeCbr']) && !empty($_POST['typeCbr'])) && (isset($_POST['dateDebutRsv']) && !empty($_POST['dateDebutRsv'])) && (isset($_POST['dateFinRsv']) && !empty($_POST['dateFinRsv'])) && (isset($_POST['nomRsv']) && !empty($_POST['nomRsv'])) && (isset($_POST['infoRsv']) && !empty($_POST['infoRsv']) ) && (isset($_POST['emailRsv']) && !empty($_POST['emailRsv']) ) )
			 {

				 if (empty($_POST['dateDebutRsv']) ) {
					 $erreur[]= 'La date d\'arrvée est inférieure à la date de départ.';
			 	 }
			     else {
					 try {
						 // On se connecte à MySQL
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
					 	$bdd = new PDO('mysql:host=localhost;dbname=hotel','root','');

						if (isset($_POST['nomRsv'])) {
							$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
							$str = 'INSERT INTO reservation';
							$str .= " VALUES ('','".mysql_escape_string($_POST['typeCbr'])."','{$dateD}','{$dateF}','".mysql_escape_string($_POST['nomRsv'])."','".mysql_escape_string($_POST['infoRsv'])."','".mysql_escape_string($_POST['emailRsv'])."')";
							$rep = $bdd->exec($str);
							
						}
						else {
							$erreur[]= 'Le nom de reservation est invalide';
						}
					 } catch( Exception $e ) {
						 die( 'Erreur : ' .$e->getMessage());
					   }
				}
			 }
			 else {
				$erreur[]= 'Vueillez vérifiez tous les champs.';
			 }
		
			 if(!empty($erreur))
			{
				foreach($erreur as $error)
				{
					echo'<div class="error">'.$error.'</div>';
				}
         		} 
		}
	    ?>
	  
      <form action="R.php" method="post">
        <table>
          <tr>
            <td>Nom de reservation</td>
            <td><input size="28px" type="text" name="nomRsv" value="<?php if (isset($_POST['nomRsv'])) echo htmlentities(trim($_POST['nomRsv'])); ?>" /></td>
          </tr>
          <tr>
            <td>Type de chambre</td>
            
	    <td><select name="typeCbr">
			      <option value="Climatisé">Climatisé </option>
			      <option value="Ventilé">Ventilé </option>
			      <option value="Suite ministérielle">Suite ministérielle </option>
			      <option value="Double standard">Double standard </option>
	    </select></td>
	     </tr>
          <tr>

	  <tr>
            <td>Date d'arrivée: </td>
            <td><input size="28px" type="text" style="cursor: pointer" size="10" name="dateDebutRsv" onclick="new calendar(this);" value="<?php if (isset($_POST['dateDebutRsv'])) echo htmlentities(trim($_POST['dateDebutRsv'])); ?>" /></td>
          </tr>
	  
	  <tr>
            <td>Date de départ: </td>
            <td><input size="28px" type="text" style="cursor: pointer" size="10" name="dateFinRsv" onclick="new calendar(this);" value="<?php if (isset($_POST['dateFinRsv'])) echo htmlentities(trim($_POST['dateFinRsv'])); ?>" /></td>
          </tr>
	  
	  <tr>
            <td>Email: </td>
            <td><input size="28px" type="email" name="emailRsv" value="<?php if (isset($_POST['emailRsv'])) echo htmlentities(trim($_POST['emailRsv'])); ?>" /></td>
          </tr>          
	   <tr>
	      <td>Plus d'informations: </td>
	       <td><textarea  type="text" name="infoRsv" value="<?php if (isset($_POST['infoRsv'])) echo htmlentities(trim($_POST['infoRsv'])); ?>" /></textarea></td>
	  </tr>

           <tr class="thirdLine">
           	<td colspan="2"><center><input type="submit" name="reserver" value="Reserver" style="box-shadow: 0px 2px 5px #1c1a19; " />
      		      <input type="reset" style="box-shadow : 0px 2px 5px #1c1a19;"></center>
		</td>
          </tr>
        </table>
      </form>
    </div>
  </div>
			</td>
          </tr>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="index.html">Accueil</a>     ::     <a href="reservation.php">R&eacute;servation</a>     ::     <a href="contact.php">Informations personnelles</a><br />    Copyright &copy; 2003-2006 companyname.com. All Rights Reserved.</pre></td>
  </tr>
</table>
</body>
</html>