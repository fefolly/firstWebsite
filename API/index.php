<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>Hôtel Eda Oba</title>
<link href="css.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" href="cal.css" media="screen" />-->

    
</head>
<body background-color:#b4732f;>

<center>
   

    <div id="middle" style="background: bottom, border: medium" >
            <div class="section2">
            
            <?php
			if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
   				    if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
						try {
							    // On se connecte à MySQL
							    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
							    $bdd = new PDO('mysql:host=localhost;dbname=hotel','root','');
							
							    // on teste si la base contient ce couple login/mot de passe
							    $reponse = $bdd->query('SELECT count(*) FROM client WHERE pseudo="'.($_POST['pseudo']).'" AND password="'.($_POST['password']).'"')->fetchColumn();
							   
							   $sonnom = $bdd->query('SELECT nomCli FROM client WHERE  password="'.($_POST['password']).'"')->fetchColumn();
							   $sonid = $bdd->query('SELECT idCli FROM client WHERE  password="'.($_POST['password']).'"')->fetchColumn();
						} catch(Exception $e) {
							die( 'Erreur : ' .$e->getMessage());
						  }
					
				    }
					 // si on obtient une réponse = 1, alors l'utilisateur est un membre
							    if ($reponse==1) {session_start();								
									$_SESSION['pseudo'] = $_POST['pseudo'];
									$_SESSION['nom'] = $sonnom;
									$_SESSION['identifiant'] = $sonid;
									header('Location: eReserv.php');
									exit();
							    }
							
							// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
							    elseif ($reponse!=1) {
									$erreur [] = 'Compte non reconnu.';
							    }
      						// sinon, alors la, il y a un gros problème :)
      						else {
         						$erreur [] = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
      						}
						
						if(!empty($erreur)) {					
							    foreach($erreur as $error)
							    {
									echo'<div class="error">'.$error.'</div>';
							    }
						} 
					
						
					}
			?>
		<p>
		      <h1>Vueillez vous connecter afin d'effectuer votre réservation</h1>
		</p>

            <table border="3px outset">
	    <tr>
		<td>



                <form action="index.php" method="post">
                    <table>
                        <tr>
                            <td>Pseudo</td>
                            <td> <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])) ?>" /> </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td> <input type="password" name="password" /> </td>
                        </tr>
                        <tr class="thirdLine">
                            <td colspan="2"> <input type="submit" name="connexion" value="Connexion" style="box-shadow: 0px 2px 5px #1c1a19; " /> </td>
                        </tr>
                        <tr>
                            <td><a href="API/inscription.php">S'inscrire</a></td>
                        </tr>
                    </table>
                </form>
		</td>
	    </tr>

		</table>

            </div>
        </div>
    	 
        
    </div>
    
   </center>

</body>
</html>

