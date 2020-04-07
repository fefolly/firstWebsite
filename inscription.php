<!DOCTYPE html>
<html >
<head>
<meta charset="ISO-8859-1" />
<title>H�tel Eda Oba</title>
<link href="css.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="cal.css" media="screen" />
</head>
<body>
<center>
<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" class="body" style="padding-bottom:10px;">
			
			
	
      <?php
			
				    	    	
			
	if(isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription'){
					
					// on teste l'existence de nos variables. On teste �galement si elles ne sont pas vides
					
					 if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['prenom']) && !empty($_POST['prenom'])) && (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['repeatpassword']) && !empty($_POST['repeatpassword'])) ) {
						 
						 if ($_POST['password'] != $_POST['repeatpassword']) {
							 $erreur[]= 'Les 2 mots de passe sont diff�rents.';
					 	 }
					     else {
							 try {
								 // On se connecte � MySQL
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
							 	$bdd = new PDO('mysql:host=localhost;dbname=hotel','root','');
								//echo 'ok';
								// on recherche si ce login est d�j� utilis� par un autre membre
								$reponse = $bdd->query('SELECT count(*) FROM client WHERE pseudo="'.mysql_escape_string($_POST['pseudo']).'"')->fetchColumn();
								//$rslt = $reponse->fetch();
								//echo $reponse;
								//$reponse->closeCursor();
								//var_dump($rslt);
								if ($reponse == 0) {
									$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
									$str = 'INSERT INTO client';
									$str .= " VALUES ('','".mysql_escape_string($_POST['nomcli'])."','".mysql_escape_string($_POST['prenomcli'])."','".mysql_escape_string($_POST['emailcli'])."',null,'".mysql_escape_string($_POST['adresscli'])."','".mysql_escape_string($_POST['pseudo'])."','".mysql_escape_string($_POST['password'])."','{$date}')";
									$rep = $bdd->exec($str);
									
									session_start();
									$_SESSION['pseudo'] = $_POST['pseudo'];
									header('Location: contact.php');
									exit();
									
								}
								else {
									$erreur[]= 'Un membre poss�de d�j� ce login.';
								}
								
							 } catch( Exception $e ) {
								 die( 'Erreur : ' .$e->getMessage());
							   }
						}
					 }
					 else {
						$erreur[]= 'Au moins un des champs est vide.';
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
            <td><input size="28px" type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>" /></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Prenoms</td>
            <td><input size="28px" type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>" /></td>
          </tr>
          <tr>
          <tr>
            <td><sup style="color: red;">*</sup>Pseudo</td>
            <td><input size="28px" type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>" /></td>
          </tr>
          
            <td><sup style="color: red;">*</sup>Sexe</td>
            <td><select name="sexe">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
              </select></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Date de naissance</td>
            <td>
		  <select name="day" id="day">
		    <?php											
		      for ($i = 1; $i <= 9; $i++)
			echo '<option value="'.$i.'">0'.$i.'</option>';
		      for ($i = 10; $i <= 31; $i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
		    ?>
		  </select>
		  <select name="month">
		    <option value="01">Janvier</option>
		    <option value="02">F�vrier</option>
		    <option value="03">Mars</option>
		    <option value="04">Avril</option>
		    <option value="05">Mai</option>
		    <option value="06">Juin</option>
		    <option value="07">Juillet</option>
		    <option value="08">Ao�t</option>
		    <option value="09">Septembre</option>
		    <option value="10">Octobre</option>
		    <option value="11">Novembre</option>
		    <option value="12">D�cembre</option>
		  </select>
							
		  <select name="year">
		    <?php
		      for ($i = intval(date('Y')); $i >= 1960; $i--)
			 echo '<option value="'.$i.'">'.$i.'</option>';
		    ?>
		  </select>
	    </td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Votre adresse electronique</td>
            <td><input size="28px" type="text" name="email" value="<?php if (isset($_POST['email'])) echo htmlentities(trim($_POST['email'])); ?>" /></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Mot de passe</td>
            <td><input size="28px" type="password" name="password" /></td>
          </tr>
          <tr>
            <td><sup style="color: red;">*</sup>Retapez le mot de passe</td>
            <td><input size="28px" type="password" name="repeatpassword" /> </td>
           </tr>
           <tr class="thirdLine">
           	<td colspan="2"><input type="submit" name="inscription" value="Inscription" style="box-shadow: 0px 2px 5px #1c1a19; " /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  
  
	
			
			?>
			
			
			
			</td>
          </tr>
</table></center>
</body>
</html>