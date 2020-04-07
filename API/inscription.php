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

	  <center><p><h1>Ici, inscrivez-vous </h1></p></center>
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
if (isset($_POST['inscription'])){
    $timeD = " 00:00:00";
    $timeF = " 23:59:59";
    /*$D= addslashes($_POST['dateD']);
    $F= addslashes($_POST['dateF']);
    $dateD=$D.$timeD;
    $dateF=$F.$timeF;*/
    
    $D = addslashes($_POST['dateNaissCli']);
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
    }
?>			
	
      <?php
			
				    	    	
			
	if(isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription'){
					
					// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
					
					 if ((isset($_POST['nomCli']) && !empty($_POST['nomCli'])) && (isset($_POST['prenCli']) && !empty($_POST['prenCli'])) && (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['repeatpassword']) && !empty($_POST['repeatpassword'])) )
					 {
	 
						 if ($_POST['password'] != $_POST['repeatpassword']) {
							 $erreur[]= 'Les 2 mots de passe sont différents.';
					 	 }
					     else {
							 try {
								 // On se connecte à MySQL
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
							 	$bdd = new PDO('mysql:host=localhost;dbname=hotel','root','');
								
								// on recherche si ce login est déjà utilisé par un autre membre
								$reponse = $bdd->query('SELECT count(*) FROM client WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'"')->fetchColumn();
								
								if ($reponse == 0) {
									$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
									$str = 'INSERT INTO client';
									$str .= " VALUES ('','".mysql_escape_string($_POST['nomCli'])."','".mysql_escape_string($_POST['prenCli'])."','".mysql_escape_string($_POST['emailCli'])."','".mysql_escape_string($_POST['telCli'])."','".mysql_escape_string($_POST['adressCli'])."','".mysql_escape_string($_POST['pseudo'])."','".mysql_escape_string($_POST['password'])."','".mysql_escape_string($_POST['sexeCli'])."','".mysql_escape_string($_POST['paysCli'])."','{$dateD}')";
									$rep = $bdd->exec($str);
									
									session_start();
									$_SESSION['pseudo'] = $_POST['pseudo'];
									header('Location: reservRech.php');
									exit();
									
								}
								else {
									$erreur[]= 'Ce login existe dejà.';
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
	 
      <form action="inscription.php" method="post">
        <table>
          <tr>
            <td><sup style="color: red;">*</sup>Nom</td>
            <td><input size="28px" type="text" name="nomCli" value="<?php if (isset($_POST['nomCli'])) echo htmlentities(trim($_POST['nomCli'])); ?>" /></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Prenoms</td>
            <td><input size="28px" type="text" name="prenCli" value="<?php if (isset($_POST['prenCli'])) echo htmlentities(trim($_POST['prenCli'])); ?>" /></td>
          </tr>
          <tr>
          <tr>
            <td><sup style="color: red;">*</sup>Pseudo</td>
            <td><input size="28px" type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>" /></td>
          </tr>
          
	  <tr>
            <td><sup style="color: red;">*</sup>Mot de passe: </td>
            <td><input size="28px" type="password" name="password" /></td>
          </tr>
	  
          <tr>
            <td><sup style="color: red;">*</sup>Retapez le mot de passe</td>
            <td><input size="28px" type="password" name="repeatpassword" /> </td>
           </tr>
	  <tr>
            <td><sup style="color: red;">*</sup>Sexe</td>
            <td><select name="sexeCli">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
              </select></td>
          </tr>
          <!--<tr>
            <td><sup style="color: red;">*</sup>Date de naissance</td>
            <td>
		  <select name="day" id="day">
		    //<?php											
		     // for ($i = 1; $i <= 9; $i++)
			//echo '<option value="'.$i.'">0'.$i.'</option>';
		      //for ($i = 10; $i <= 31; $i++)
		//	echo '<option value="'.$i.'">'.$i.'</option>';
		  //  ?>
		  </select>
		  <select name="month">
		    <option value="01">Janvier</option>
		    <option value="02">Février</option>
		    <option value="03">Mars</option>
		    <option value="04">Avril</option>
		    <option value="05">Mai</option>
		    <option value="06">Juin</option>
		    <option value="07">Juillet</option>
		    <option value="08">Août</option>
		    <option value="09">Septembre</option>
		    <option value="10">Octobre</option>
		    <option value="11">Novembre</option>
		    <option value="12">Décembre</option>
		  </select>
							
		  <select name="year">
		 //   <?php
		   //   for ($i = intval(date('Y')); $i >= 1960; $i--)
			// echo '<option value="'.$i.'">'.$i.'</option>';
		    //?>
		  </select>
	    </td>
          </tr>-->
	  <tr>
            <td><sup style="color: red;">*</sup>Date de naissance: </td>
            <td><input size="28px" type="text" style="cursor: pointer" size="10" name="dateNaissCli" onclick="new calendar(this);" value="<?php if (isset($_POST['dateNaissCli'])) echo htmlentities(trim($_POST['dateNaissCli'])); ?>" /></td>
          </tr>
	  <tr>
            <td><sup style="color: red;">*</sup>Telephone: </td>
            <td><input size="28px" type="text" name="telCli" value="<?php if (isset($_POST['telCli'])) echo htmlentities(trim($_POST['telCli'])); ?>" /></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Votre adresse electronique: </td>
            <td><input size="28px" type="email" name="emailCli" value="<?php if (isset($_POST['emailCli'])) echo htmlentities(trim($_POST['emailCli'])); ?>" /></td>
          </tr>
	  
	  <tr>
            <td><sup style="color: red;">*</sup>Pays</td>
            <td><select name="paysCli">
			      <option value="Togo" selected="selected">Togo </option>

			      <option value="Afghanistan">Afghanistan </option>
			      <option value="Afrique_Centrale">Afrique_Centrale </option>
			      <option value="Afrique_du_sud">Afrique_du_Sud </option>
			      <option value="Albanie">Albanie </option>
			      <option value="Algerie">Algerie </option>
			      <option value="Allemagne">Allemagne </option>
			      <option value="Andorre">Andorre </option>
			      <option value="Angola">Angola </option>
			      <option value="Anguilla">Anguilla </option>
			      <option value="Arabie_Saoudite">Arabie_Saoudite </option>
			      <option value="Argentine">Argentine </option>
			      <option value="Armenie">Armenie </option>
			      <option value="Australie">Australie </option>
			      <option value="Autriche">Autriche </option>
			      <option value="Azerbaidjan">Azerbaidjan </option>
	  
			      <option value="Bahamas">Bahamas </option>
			      <option value="Bangladesh">Bangladesh </option>
			      <option value="Barbade">Barbade </option>
			      <option value="Bahrein">Bahrein </option>
			      <option value="Belgique">Belgique </option>
			      <option value="Belize">Belize </option>
			      <option value="Benin">Benin </option>
			      <option value="Bermudes">Bermudes </option>
			      <option value="Bielorussie">Bielorussie </option>
			      <option value="Bolivie">Bolivie </option>
			      <option value="Botswana">Botswana </option>
			      <option value="Bhoutan">Bhoutan </option>
			      <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
			      <option value="Bresil">Bresil </option>
			      <option value="Brunei">Brunei </option>
			      <option value="Bulgarie">Bulgarie </option>
			      <option value="Burkina_Faso">Burkina_Faso </option>
			      <option value="Burundi">Burundi </option>
			      
			      <option value="Caiman">Caiman </option>
			      <option value="Cambodge">Cambodge </option>
			      <option value="Cameroun">Cameroun </option>
			      <option value="Canada">Canada </option>
			      <option value="Canaries">Canaries </option>
			      <option value="Cap_vert">Cap_Vert </option>
			      <option value="Chili">Chili </option>
			      <option value="Chine">Chine </option>
			      <option value="Chypre">Chypre </option>
			      <option value="Colombie">Colombie </option>
			      <option value="Comores">Colombie </option>
			      <option value="Congo">Congo </option>
			      <option value="Congo_democratique">Congo_democratique </option>
			      <option value="Cook">Cook </option>
			      <option value="Coree_du_Nord">Coree_du_Nord </option>
			      <option value="Coree_du_Sud">Coree_du_Sud </option>
			      <option value="Costa_Rica">Costa_Rica </option>
			      <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
			      <option value="Croatie">Croatie </option>
			      <option value="Cuba">Cuba </option>
			      
			      <option value="Danemark">Danemark </option>
			      <option value="Djibouti">Djibouti </option>
			      <option value="Dominique">Dominique </option>
			      <option value="Egypte">Egypte </option>
			      <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
			      <option value="Equateur">Equateur </option>
			      <option value="Erythree">Erythree </option>
			      <option value="Espagne">Espagne </option>
			      <option value="Estonie">Estonie </option>
			      <option value="Etats_Unis">Etats_Unis </option>
			      <option value="Ethiopie">Ethiopie </option>
			      
			      <option value="Falkland">Falkland </option>
			      <option value="Feroe">Feroe </option>
			      <option value="Fidji">Fidji </option>
			      <option value="Finlande">Finlande </option>
			      <option value="France">France </option>
			      
			      <option value="Gabon">Gabon </option>
			      <option value="Gambie">Gambie </option>
			      <option value="Georgie">Georgie </option>
			      <option value="Ghana">Ghana </option>
			      <option value="Gibraltar">Gibraltar </option>
			      <option value="Grece">Grece </option>
			      <option value="Grenade">Grenade </option>
			      <option value="Groenland">Groenland </option>
			      <option value="Guadeloupe">Guadeloupe </option>
			      <option value="Guam">Guam </option>
			      <option value="Guatemala">Guatemala</option>
			      <option value="Guernesey">Guernesey </option>
			      <option value="Guinee">Guinee </option>
			      <option value="Guinee_Bissau">Guinee_Bissau </option>
			      <option value="Guinee equatoriale">Guinee_Equatoriale </option>
			      <option value="Guyana">Guyana </option>
			      <option value="Guyane_Francaise ">Guyane_Francaise </option>
			      
			      <option value="Haiti">Haiti </option>
			      <option value="Hawaii">Hawaii </option>
			      <option value="Honduras">Honduras </option>
			      <option value="Hong_Kong">Hong_Kong </option>
			      <option value="Hongrie">Hongrie </option>
			      
			      <option value="Inde">Inde </option>
			      <option value="Indonesie">Indonesie </option>
			      <option value="Iran">Iran </option>
			      <option value="Iraq">Iraq </option>
			      <option value="Irlande">Irlande </option>
			      <option value="Islande">Islande </option>
			      <option value="Israel">Israel </option>
			      <option value="Italie">italie </option>
			      
			      <option value="Jamaique">Jamaique </option>
			      <option value="Jan Mayen">Jan Mayen </option>
			      <option value="Japon">Japon </option>
             			<option value="Jersey">Jersey </option>
			      <option value="Jordanie">Jordanie </option>

			      <option value="Kazakhstan">Kazakhstan </option>
			      <option value="Kenya">Kenya </option>
			      <option value="Kirghizstan">Kirghizistan </option>
			      <option value="Kiribati">Kiribati </option>
			      <option value="Koweit">Koweit </option>
			      
			      <option value="Laos">Laos </option>
			      <option value="Lesotho">Lesotho </option>
			      <option value="Lettonie">Lettonie </option>
			      <option value="Liban">Liban </option>
			      <option value="Liberia">Liberia </option>
			      <option value="Liechtenstein">Liechtenstein </option>
			      <option value="Lituanie">Lituanie </option>
			      <option value="Luxembourg">Luxembourg </option>
			      <option value="Lybie">Lybie </option>
			      
			      <option value="Macao">Macao </option>
			      <option value="Macedoine">Macedoine </option>
			      <option value="Madagascar">Madagascar </option>
			      <option value="Madère">Madère </option>
			      <option value="Malaisie">Malaisie </option>
			      <option value="Malawi">Malawi </option>
			      <option value="Maldives">Maldives </option>
			      <option value="Mali">Mali </option>
			      <option value="Malte">Malte </option>
			      <option value="Man">Man </option>
			      <option value="Mariannes du Nord">Mariannes du Nord </option>
			      <option value="Maroc">Maroc </option>
			      <option value="Marshall">Marshall </option>
			      <option value="Martinique">Martinique </option>
			      <option value="Maurice">Maurice </option>
			      <option value="Mauritanie">Mauritanie </option>
			      <option value="Mayotte">Mayotte </option>
			      <option value="Mexique">Mexique </option>
			      <option value="Micronesie">Micronesie </option>
			      <option value="Midway">Midway </option>
			      <option value="Moldavie">Moldavie </option>
			      <option value="Monaco">Monaco </option>
			      <option value="Mongolie">Mongolie </option>
			      <option value="Montserrat">Montserrat </option>
			      <option value="Mozambique">Mozambique </option>
			      
			      <option value="Namibie">Namibie </option>
			      <option value="Nauru">Nauru </option>
			      <option value="Nepal">Nepal </option>
			      <option value="Nicaragua">Nicaragua </option>
			      <option value="Niger">Niger </option>
			      <option value="Nigeria">Nigeria </option>
			      <option value="Niue">Niue </option>
			      <option value="Norfolk">Norfolk </option>
			      <option value="Norvege">Norvege </option>
			      <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
			      <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>
			      
			      <option value="Oman">Oman </option>
			      <option value="Ouganda">Ouganda </option>
			      <option value="Ouzbekistan">Ouzbekistan </option>
		    
			      <option value="Pakistan">Pakistan </option>
			      <option value="Palau">Palau </option>
			      <option value="Palestine">Palestine </option>
			      <option value="Panama">Panama </option>
			      <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
			      <option value="Paraguay">Paraguay </option>
			      <option value="Pays_Bas">Pays_Bas </option>
			      <option value="Perou">Perou </option>
			      <option value="Philippines">Philippines </option>
			      <option value="Pologne">Pologne </option>
			      <option value="Polynesie">Polynesie </option>
			      <option value="Porto_Rico">Porto_Rico </option>
			      <option value="Portugal">Portugal </option>
		    
			      <option value="Qatar">Qatar </option>
			      
			      <option value="Republique_Dominicaine">Republique_Dominicaine </option>
			      <option value="Republique_Tcheque">Republique_Tcheque </option>
			      <option value="Reunion">Reunion </option>
			      <option value="Roumanie">Roumanie </option>
			      <option value="Royaume_Uni">Royaume_Uni </option>
			      <option value="Russie">Russie </option>
			      <option value="Rwanda">Rwanda </option>
			      
			      <option value="Sahara Occidental">Sahara Occidental </option>
			      <option value="Sainte_Lucie">Sainte_Lucie </option>
			      <option value="Saint_Marin">Saint_Marin </option>
			      <option value="Salomon">Salomon </option>
			      <option value="Salvador">Salvador </option>
			      <option value="Samoa_Occidentales">Samoa_Occidentales</option>
			      <option value="Samoa_Americaine">Samoa_Americaine </option>
			      <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
			      <option value="Senegal">Senegal </option>
			      <option value="Seychelles">Seychelles </option>
			      <option value="Sierra Leone">Sierra Leone </option>
			      <option value="Singapour">Singapour </option>
			      <option value="Slovaquie">Slovaquie </option>
			      <option value="Slovenie">Slovenie</option>
			      <option value="Somalie">Somalie </option>
			      <option value="Soudan">Soudan </option>
			      <option value="Sri_Lanka">Sri_Lanka </option>
			      <option value="Suede">Suede </option>
			      <option value="Suisse">Suisse </option>
			      <option value="Surinam">Surinam </option>
				<option value="Swaziland">Swaziland </option>
			      <option value="Syrie">Syrie </option>

			      <option value="Tadjikistan">Tadjikistan </option>
			      <option value="Taiwan">Taiwan </option>
			      <option value="Tonga">Tonga </option>
			      <option value="Tanzanie">Tanzanie </option>
			      <option value="Tchad">Tchad </option>
			      <option value="Thailande">Thailande </option>
			      <option value="Tibet">Tibet </option>
			      <option value="Timor_Oriental">Timor_Oriental </option>
			      <option value="Togo">Togo </option>
			      <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
			      <option value="Tristan da cunha">Tristan de cuncha </option>
			      <option value="Tunisie">Tunisie </option>
			      <option value="Turkmenistan">Turmenistan </option>
			      <option value="Turquie">Turquie </option>
			      
			      <option value="Ukraine">Ukraine </option>
			      <option value="Uruguay">Uruguay </option>
			      
			      <option value="Vanuatu">Vanuatu </option>
			      <option value="Vatican">Vatican </option>
			      <option value="Venezuela">Venezuela </option>
			      <option value="Vierges_Americaines">Vierges_Americaines </option>
			      <option value="Vierges_Britanniques">Vierges_Britanniques </option>
			      <option value="Vietnam">Vietnam </option>
			      
			      <option value="Wake">Wake </option>
			      <option value="Wallis et Futuma">Wallis et Futuma </option>
			      
			      <option value="Yemen">Yemen </option>
			      <option value="Yougoslavie">Yougoslavie </option>
			      
			      <option value="Zambie">Zambie </option>
			      <option value="Zimbabwe">Zimbabwe </option>
		    
</select></td>
          </tr>
	  
	   <tr>
	      <td><sup style="color: red;">*</sup>Adresse: </td>
	       <td><textarea  type="text" name="adressCli" value="<?php if (isset($_POST['adressCli'])) echo htmlentities(trim($_POST['adressCli'])); ?>" /></textarea></td>
	  </tr>
          
           <tr class="thirdLine">
           	<td colspan="2"><center><input type="submit" name="inscription" value="Inscription" style="box-shadow: 0px 2px 5px #1c1a19; " />
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