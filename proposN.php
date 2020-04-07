<?php
		session_start();
        ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
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
      
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
             <td width="400" valign="top"><?php include_once('gallerie.html');?></td>
            
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:#FFFFFF 2px solid;">
          <tr>
            <td width="11" align="left" valign="top" bgcolor="#EABE94"><img src="images/index_31.gif" width="11" height="38" alt="" /></td>
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="index.php">Acceuil</a>                  <a href="restaurant.php">Restaurant</a>                  <a href="API/index.php" target="_blank">R&eacute;servation</a>                  <a href="proposN.php">Actualit&eacute;</a>                  <a href="galerieP.php">Galerie</a></pre></td>
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
		Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br />
	    <a href="deconnexion.php">Déconnexion</a>
	    <?php
	    }
	    ?>
		<?php include("BodyProposN.php"); ?>
		<!--     contenu   -->
		
		
		
	<td width="33%" valign="top" style="padding-left:15px;">
		<div><h2>Les dernieres nouvelles</h2></div>
		<div class="body1" style="padding:8px;"><strong>04 Novembre,12</strong><br />
Conferences sur l'hotellerie<br />
<br />
          </div>
		  <div style="text-align:center"><img src="images/index_49.gif" width="212" height="86" alt="" /></div>
		  <div class="body1" style="padding:8px;"><strong>04 Decembre,12</strong><br />
Promotion à partir du 04 pour la fin d'année.<br /></div>
<br />
<hr/>
<div class="body1" style="padding:8px;"><p> <strong><h3>Oba night club</h3> La nouvelle boite de nuit de la capitale! Le club ou vous voulez être vu!!
Outre les artistes de renommée que nous y reçevons, nous proposons aussi a notre clientèle des soirées à
thèmes!! Alors vous qui avez soif d’expériences nouvelles, rejoignez nous au plus vite pour des soirées inoubliables!
Le club se situe dans l'enceinte de l'hôtel et est ouvert les Jeudi, Vendredi et Samedi à partir de 22 h. Privatisation et Location possible.</strong></p><br /></div>
         
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="index.php">Accueil</a>     ::     <a href="proposN.php">Restaurant</a>     ::     <a href="API/index.php" target="_blank">R&eacute;servation</a>     ::     <a href="proposN.php">Actualité</a>     ::     <a href="galerieP.php">Galerie</a><br />    Copyright &copy; 2011-2012 </pre></td>
  </tr>
</table>
</body>
</html>