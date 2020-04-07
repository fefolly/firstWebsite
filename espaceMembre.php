<?php
		session_start();
			    if (!isset($_SESSION['pseudo']))
			    {
			        header ('Location: index.html');
			        exit();
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
                      <td width="50%" align="left" valign="top" >Nombre d'adultes</td>
					  <td width="50%" align="left" valign="top">Nombre d'enfants</td>
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
          
        </table></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:#FFFFFF 2px solid;">
          <tr>
            <td width="11" align="left" valign="top" bgcolor="#EABE94"><img src="images/index_31.gif" width="11" height="38" alt="" /></td>
            <td width="708" bgcolor="#EABE94"><pre class="menu"><a href="index.html">Acceuil</a>                  <a href="proposN.php">A propos de Nous</a>                  <a href="proposN.php">Services</a>                  <a href="r&eacuteservation.php">R&eacute;servation</a>                  <a href="proposN.php">Actualité</a>                  <a href="contact.php">Contacts</a></pre></td>
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
		
		
		
                <p>
                    Ici sera possible de consuter tout ce qui concerne ses reservations.</br>
                    Mais pour le moment la page est en construction. <strong>Merci. (y) </strong>>  
                </p>
                
                


	    Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br />
	    <a href="deconnexion.php">Déconnexion</a>
                	<!--     contenu   -->

		
		
		</td>
        <td width="33%" valign="top" style="padding-left:15px;">
		<div><img src="images/index_39.gif" width="162" height="26" alt="" /></div>
		<div class="body1" style="padding:8px;"><strong>04th Octber,06</strong><br />
In feugiat. Sed et turpis ac risus aliquet . Nam cursus  lobortis.<br />
<br />
          <a href="#"><strong>read more</strong></a></div>
		  <div style="text-align:center"><img src="images/index_49.gif" width="212" height="86" alt="" /></div>
		  <div class="body1" style="padding:8px;"><strong>04th Octber,06</strong><br />
In feugiat. Sed et turpis ac risus aliquet rhoncus Nam cursus.<br />
<br />
          <a href="#"><strong>read more</strong></a></div>
		  <div class="body1" style="padding:8px;"><strong>04th Octber,06</strong><br />
In feugiat. Sed et turpis ac risus aliquet rhoncus nam cursus.<br />
<br />
          <a href="#"><strong>read more</strong></a></div>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="82" bgcolor="#AA6F47" style="background-image:url(images/index_61.gif); background-position:bottom; background-repeat:repeat-x;"><pre class="footer"><a href="index.html">Accueil</a>     ::     <a href="proposN.php">A Propos de Nous</a>     ::     <a href="proposN.php">Services</a>     ::     <a href="reservation.php">R&eacute;servation</a>     ::     <a href="proposN.php">Actualité</a>     ::     <a href="contact.php">Contacts</a><br />    Copyright &copy; 2003-2006 companyname.com. All Rights Reserved.</pre></td>
  </tr>
</table>
</body>
</html>