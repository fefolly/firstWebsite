<?php
		session_start();
			    if (!isset($_SESSION['pseudo']))
			    
          ?>  

<?php
    require 'autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new ReservationManager_PDO($db);
 

  
    if (isset($_POST['reserver']) and isset($_POST['dateDebutRsv']))
    {
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
    $jrF=$datexF[0];
    $moisF=$datexF[1];
    $anneF=$datexF[2];
    
    if(strlen($jrD)==1)$jrD='0'.$jrD;
    if(strlen($moisD)==1)$moisD='0'.$moisD;
    
    if(strlen($jrF)==1)$jrF='0'.$jrF;
    if(strlen($moisF)==1)$moisF='0'.$moisF;
    //if(strlen($anne)==1)$anne='0'.$anne;
    $D =$jrD.$moisD.$anneD;
    $F =$jrF.$moisF.$anneF;
    
    
    $dateD=formatJjmmaaaaTOaaaammjj($D).$timeD;
    $dateF=formatJjmmaaaaTOaaaammjj($F).$timeF;
        
        $reservation = new Reservation (
        array (
                'idCli' => $_POST['idCli'],
                //'codeFct' => $_POST['codeFct'],
                //'numRsv' => $_POST['numRsv'],
                'typeCbr' => $_POST['typeCbr'],
                'dateDebutRsv' =>  $dateD,
                'dateFinRsv' => $dateF,
                'numCbr' => $_POST['numCbr'],
                'nomRsv' => $_POST['nomRsv'],
                'infoRsv' => $_POST['infoRsv'],
                'emailRsv' => $_POST['emailRsv']
             )
    );
    
    
    if (isset($_POST['codeRsv']))
        $reservation->setCodeRsv($_POST['codeRsv']);

    if ($reservation->isValid())
    {
        $manager->save($reservation);
        $message = $reservation->isNew() ? 'La reservation a bien été effectuée!' : 'La reservation a bien été modifiée !';
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



<?php
	  function formatJjmmaaaaTOaaaammjj($d){
	      $d2=substr($d,4,4).'-'.substr($d,2,2).'-'.substr($d,0,2);
	      return $d2;
    }

?>
        
        <?php
        
/*
 if (isset($_POST['dateDebutRsv'])){
    $timeD = " 00:00:00";
    $timeF = " 23:59:59";
    /*$D= addslashes($_POST['dateD']);
    $F= addslashes($_POST['dateF']);
    $dateD=$D.$timeD;
    $dateF=$F.$timeF;*/
    
    /*$D = addslashes($_POST['dateDebutRsv']);
   // $F= addslashes($_POST['dateF']);
   // $PMEPhone= addslashes($_POST['PMEPhone']);
   // $PMEId= addslashes($_POST['PMEId']);
   // $solde= addslashes($_POST['solde']);
    
    $datexD=explode("/",$D);
   // $datexF=explode("/",$F);
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
    //$F =$jrF.$moisF.$anneF;
    
    
    $dateD=formatJjmmaaaaTOaaaammjj($D).$timeD;
    //$dateF=formatJjmmaaaaTOaaaammjj($F).$timeF;
    }*/
?>

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
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="reserv.php">Acceuil</a>                <a href="reserv.php">R&eacute;servation</a>                 <a href="">Paiement</a></pre></td>
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
		<?php if(isset($_SESSION['pseudo']))
		{
		?>
		<strong>Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br />
	    <a href="deconnexion.php">Déconnexion</a></strong>
	    <?php
	    }
	    ?>
	    
	    
	    </center>
            </table>
        </center>
         <tr>        
<td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="index.html">Accueil</a>     ::     <a href="reservation.php">R&eacute;servation</a>     ::     <a href="">Paiement</a><br />    Copyright &copy; 2011-2012 </pre></td>
       </tr>
        </table>
</body>
</html>