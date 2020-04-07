
   
    <div id="middle">
            <div class="section2">
            
            <?php
			if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
   				    if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
						try {
							    // On se connecte à MySQL
							    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
							    $bdd = new PDO('mysql:host=localhost;dbname=hotel','root','');
							
							    // on teste si une entrée de la base contient ce couple login / pass
							    $reponse = $bdd->query('SELECT count(*) FROM client WHERE pseudo="'.($_POST['pseudo']).'" AND password="'.($_POST['password']).'"')->fetchColumn();
							    /*$rslt=$reponse->fetch(PDO::FETCH_ASSOC);*/
							    //$reponse->bind_result('i',$j);
							    //echo $reponse;											
							    //$reponse->closeCursor();
							
							
   										
						} catch(Exception $e) {
							die( 'Erreur : ' .$e->getMessage());
						  }
					
				    }
					 // si on obtient une réponse = 1, alors l'utilisateur est un membre
							    if ($reponse == 1) {session_start();								
									$_SESSION['pseudo'] = $_POST['pseudo'];								
									header('Location: API/reserv.php');
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
            
                <form action="connexion.php" method="post">
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
                            <td><a href="API/inscription.php"  target="_blank">S'inscrire</a></td>
                        </tr>
                    </table>
                </form>
                
            </div>
        </div>
    	 
        
    </div>