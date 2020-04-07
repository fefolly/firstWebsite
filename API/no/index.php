<?php
$version="2.1";//version (ne pas modifier)

////////////-------------- debut configuration  -----------------//////////

//mettre le mot de passe ici
$motdepasse="";

//titre de la page html
$title="Galerie d'images";
//nombre d'images par ligne
$nb_colone=4;
//largeur max de la miniature
$max_largeur=200;
//hauteur max de la miniature
$max_longeur=200;

//activer les fonctions admin (renommer, suppression) 1:active 0: inactive
//il est conseillé de désactiver si vous donner le mot de passe à une autre personne
$admin=1;

//si vous voulez generez les miniatures sur le serveur(0:non, 1:oui)
$generer=1; 

//option pour afficher ou non le formulaire d'upload (1:oui, 0:non)
$formulaire_upload=1;
//option pour afficher ou non le formulaire de recherche (1:oui, 0:non)
$formulaire_recherche=1;

//version de la librairie GD, si vous ne savez pas, essayer 2, si ça ne marche pas, mettez 1.
$gd=2;

//est ce que votre version de GD supporte les gif? (1:oui 0:non)
//si vous ne savez, essayer de mettre 1, et si les miniatures des gif de s'affiche pas, alors mettez 0
$gd_gif=0;

//si vous voulez rajouter des variables aux urls:
$variable_url='';

//message:
//si vous voulez mettre un message pour les differentes galeries, 
//vous devez mettre un fichier message.txt, contenant le message, dans le dossier .

// pour modifier le design, modifier ces fonctions:


//design du haut de la page
function tete($title)
{
	//include('tete.php');
	echo '<html><head><title>'.$title.'</title></head><body>';
}

//design du bas de la page 
function pied()
{
	//include('pied.php');
	echo '</body></html>';

}

///////////--------------  fin configuration de la galerie ----------------//////////

if($motdepasse=="toi") die("il n'y a pas de mot de passe, mettez en un!");

if(isset($_GET['dossier']))
{
	$dossier=$_GET['dossier'];
}
else
{
	$dossier="";
}

if(isset($_GET['act']))
{
	$act=$_GET['act'];
}
elseif(isset($_POST['act']))
{
	$act=$_POST['act'];
}

if(isset($_REQUEST ['img']))
{
	$img=$_REQUEST['img'];
}
else
{
	$img="";
}

if(isset($_REQUEST['mdp']))
{
	$mdp=$_REQUEST['mdp'];
}

if(isset($_REQUEST['nom']))
{
	$nom=$_REQUEST['nom'];
}

if(isset($_REQUEST['NomFichier']))
{
	$NomFichier=$_REQUEST['NomFichier'];
}


//nom du dossier
$dirname=pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME);
//chemin du dossier
$path=".".$dirname;

//chemin depuis la racine du serveur
$chemin=$_SERVER['DOCUMENT_ROOT'];

//nom de la page
$nom_page=$_SERVER['SCRIPT_NAME'];

//$dossier=urldecode($dossier);
$path=rawurlencode($path);
$path=str_replace('%2F','/',$path);
//$dossier=rawurlencode($dossier);
$dossier=str_replace('%2F','/',$dossier);

$dossier=str_replace(".","",$dossier);
$chemin_entier=$chemin.$dirname."/".$dossier;

/**
 * echo "<br /><b>\$path:</b> $path ";
echo "<br /><b>\$chemin</b>: $chemin ";
echo "<br /><b>\$dossier</b>: $dossier";	
echo "<br /><b>\$chemin_entier</b>: $chemin_entier<br />";
 */

if(!isset($dossier) || $dossier=="")
{

//$dossier=$path;
/**
 * 	$dossier=$path;
	if(@$act!="thumb" )
	{
		
		chdir($path);
	}
	
 */
 
}
else
{

	chdir($chemin_entier);	
	
}





if(!isset($act)) $act="";

switch($act)
{
	case "upload":
	if($mdp!=$motdepasse) die ("mauvais mot de passe");
	verif_fichier($NomFichier);
	upload();
	break;

	case "thumb":
	thumb($img);
	break;
	
	case "supprimer":
	if($admin==1)
	supprimer($img);
	else
	echo "la suppression a été désactivé";
	break;
	
	case "renommer":
	if($admin==1)
	renommer($img,$nom);
	else
	echo "cette fonction est désactivé";
	break;

	default :
	tete($title);
	if($formulaire_upload==1){	afficher_formulaire_upload();	}
	if($formulaire_recherche==1){ afficher_formulaire_recherche();}

	upload_liste_fichier();
	//merci de ne pas enlever cette ligne
	copyright();
	pied();
	break;
}





///-------------------- liste des fonctions ----------------------////


function tab_list_dir($dossier)
{
	global $variable_url,$path;
	
	$d=opendir(".");
	
	
	//$dir[]="<a href=\"?$variable_url\">Galerie principale</a>";
	while($f=readdir($d))
	{
		
		if (!is_file($f) && $f != "." && $f != ".." && $f!="index.php" && $f!=".htaccess")
		{	
			if($dossier=="" || $dossier=="." || !isset($dossier))
			{
				$dir[]=" <a href=\"?dossier=".$f.$variable_url."\">".$f."</a> ";
			}
			else
			{
				$dir[]=" <a href=\"?dossier=".$dossier."/".$f.$variable_url."\">".$f."</a> ";
			}
			
		}
		 
		 
		
	}
 	closedir();
 	@sort($dir);
	return $dir;
}


function renommer($img,$nom)
{
 global $mdp,$motdepasse,$dossier,$variable_url;
 
	if($mdp==$motdepasse && $nom!="" && isset($nom))
	{
		
		//if(@rename($dossier.'/'.$img,$dossier.'/'.$nom))
		if(@rename($img,$nom))
		{
			echo "l'image <b>$img</b> a été renommé avec succès en : <b>$nom</b>";
		}
		else
		{
			echo "changement de nom echoué<br />";
			echo $dossier.'/'.$img;
			echo '<br />'.$dossier.'/'.$nom;
		}
		echo "<br /><a href=\"?dossier=".$dossier.$variable_url."\">retour à la galerie</a>";
	}
	else
	{
		echo"
		<div style=\"background:#C0C0C0;width:40%;\">
		<b>renommer une image</b><br /><br />
		<form>
		<b>nom d'origine:</b> $img
		<input type=\"hidden\" name=\"img\" value=\"$img\"><br />
		<b> nouveau nom :</b> <input type=\"text\" name=\"nom\" value=\"$img\"><br />
		<b>mot de passe:</b> <input type=\"password\" name=\"mdp\"><br />
		<input type=\"hidden\" name=\"act\" value=\"renommer\">
		<input type=\"hidden\" name=\"dossier\" value=\"".$dossier."\">
		<input type=\"submit\" value=\"envoyer\"><br />
		</form>
		</div>";	
	}


}

function supprimer($img)
{
 global $mdp,$motdepasse,$dossier;
 
	if($mdp==$motdepasse)
	{
		if(unlink($img))
		{
			echo "l'image <b>$img</b> a été supprimé avec succès";
		}
		else
		{
			echo "suppresion echoué";
		}
		echo "<br /><a href=\"?dossier=".$dossier.$variable_url."\">retour à la galerie</a>";
	}
	else
	{
		echo"
		
		<div style=\"background:#C0C0C0;width:30%;\">
		<b>supprimer une image</b><br /><br />
		<form>
		<b>image:</b> <input type=\"text\" name=\"img\" value=\"$img\"><br />
		<b>mot de passe:</b> <input type=\"password\" name=\"mdp\"><br />
		<input type=\"hidden\" name=\"act\" value=\"supprimer\">
		<input type=\"hidden\" name=\"dossier\" value=\"$dossier\">
		<input type=\"submit\" value=\"envoyer\"><br />
		</form>
		</div>	";	
	}

	

}


function alert($message)
{
echo "<br /><table align=\"center\" style=\"border:1px solid #C0c0c0;\"><tr><td><h4>$message</h4></td></tr></table>";
}

function verif_fichier($NomFichier)
{
	if (!preg_match ("/^(.*)\.(jpg|png|gif|jpeg)$/i", $_FILES["NomFichier"]["name"] )) 
	{
 	  exit (alert("fichier non autorisé, on a le droit seulement aux extension jpg,jpeg,png,gif"));
	
	} 
	
}

function tab_image($dossier)
{

//dossiers qui contient les fichiers
	$d=opendir(".");
	
	//scan du dossier
	while($f=readdir($d))
	{
		if (preg_match ("/^(.*)\.(jpg|png|gif|jpeg)$/i", $f))
		{
			$is_image=true;
		}
		else
		{
			$is_image=false;
		}
		if ($f != "." && $f != ".." && $f!="index.php" && $f!=".htaccess" && $is_image)
		$dir[]=$f;
	}
 	closedir();
 	@sort($dir);
	return $dir;

}

function tab_recherche($mot)
{
	global $dossier;
	
	//on recherche la liste des images du dossier.
	$dir=tab_image($dossier);
	$num=count($dir);
	
	 
	$i=0;
	while($i<$num)
	{
		if (preg_match ("/^(.*)$mot(.*)$/i", $dir[$i]))
		{
			$tab_recherche[]=$dir[$i];
			//echo $dir[$i];
		}
 		$i++;
	}
	
	return @$tab_recherche;
}



function upload_liste_fichier()
{	
	global $admin,$path,$HTTP_HOST,$REQUEST_URI,$nb_colone,$mot,$dossier,$variable_url,$nom_page,$gd_gif,$generer;
	
	echo '<h2 align="center"> Les galeries de photos</h2>';
	
		
	if(isset($mot) && $mot!="")
	{
		$dir=tab_recherche($mot);
		
		echo "<p align=\"center\"><a href=\"?dossier=".$dossier.$variable_url."\" ><b>retour à la liste</b></a></p>";
		
		$num=count($dir);
		if($num==1 || $num==0 )
		{
			echo"<p> $num photo a été trouvé pour le mot <b> $mot </b></p>";
		}
		else
		{
			echo"<p> $num photos ont été trouvé pour le mot <b>$mot</b></p>";
		}
	}
	else
	{
		$dir=tab_image($dossier);
		
		//on compte le nombre de fichier trouvé dans le dossier
 		$num=count($dir);
		
		//debut de la fonction pour creer le menu
		$tab_dossier=explode("/",$dossier);
		
		$nb_dossier=count($tab_dossier);
		
		$menu_dossier='<a href="?'.$variable_url.'"> Galerie Principale </a> / ';
		
		
		//si c'est un sous dossier
		if(isset($dossier) && $dossier!="" && $dossier!="." )
		{
			$arbo=$tab_dossier[0];
			$i=0;
			while($i<$nb_dossier)
			{
				if($i==$nb_dossier-1)
				{
					$menu_dossier.=rawurldecode($tab_dossier[$i]).' / ';
				}
				else
				{
					$menu_dossier.='<a href="?dossier='.$arbo.$variable_url.'">'.rawurldecode($tab_dossier[$i]).'</a> / ';
				}
				
				$i++;
				if($i<$nb_dossier)
				{
				
				$arbo.='/'.$tab_dossier[$i];	
				}
				
			
			}
		}
		echo '<p>'.$menu_dossier.'</p>';
		//fin fonction pour creer le menu
		

		$tab_list_dir = tab_list_dir($dossier);
		$num_dir=count($tab_list_dir);
		
		if($dossier==$path)
		{
			$repertoire='Galerie Principale';
		}
		else
		{
			$repertoire=$dossier;
		}
		if($num_dir>0)
		{
			echo '<p>Dossiers qui se trouvent dans le repertoire <b>'.$repertoire.	'</b>:</p>';
		}
		echo tableau_html($tab_list_dir,4,"#F0F0F0","#E4E4E4");
		
		
		if(file_exists('./message.txt'))
		{	
			echo '<br /><br />';
			include('message.txt');
			echo '<br /><br />';
		}
		
		
		
		if($num==1 )
		{
			echo"<p>il y a $num photo dans : <b>".rawurldecode($dossier)."</b></p>";
		}	
		elseif($num!=0)
		{
			echo"<p>il y a $num photos dans : <b>".rawurldecode($dossier)."</b></p>";
		}
	}
	


 	$i=0;
	
	echo "\n<table class=\"classique\" border=\"0\" width=\"90%\" align=\"center\"><tr bgcolor=\"#E4E4E4\">";
	$width=100/$nb_colone;
	$nb_ligne=0;
	while($i<$num || $i%$nb_colone!=0)
	{	
		if($nb_ligne%2==0)
		{
			$couleur="#F0F0F0";
		}
		else
		{
			$couleur="#E4E4E4";
		}
		if($i<$num)
		{
		
		    $dir[$i]=rawurlencode($dir[$i]);
			if (preg_match ("/^(.*)\.gif$/i", $dir[$i]) && $gd_gif==0)
			{
				if(!isset($dossier) || $dossier=="" || $dossier==".")
				{
					echo "\n<td width=\"$width%\" ><a href=\"./".$dir[$i]."\" target=\"blank\"> (pas de miniature) <br />".rawurldecode($dir[$i]).'</a>';
				}
				else
				{
					echo "\n<td width=\"$width%\" ><a href=\"./".$dossier."/".$dir[$i]."\" target=\"_blank\">(pas de miniature) <br />".rawurldecode($dir[$i])."</a>";
				}
				
				if($admin==1)
				{
					echo"<br /> <a href=\"?act=supprimer&dossier=".$dossier."&img=$dir[$i]".$variable_url."\">supprimer</a>";
					echo"<br /> <a href=\"?act=renommer&dossier=".$dossier."&img=$dir[$i]".$variable_url."\">renommer</a>";
				}

				echo"</td>";
				
			}
			else
			{
				$thumb='';
				//si on doit generer les miniatures
				if($generer==1)
				{
					//si la miniature n'existe pas on la créé 
					if(!file_exists('_thumb_'.rawurldecode($dir[$i]).'.thumb'))
					{
						//generation de la miniature
						$thumb=thumb(rawurldecode($dir[$i]),1);
					}
					
				}
				//si on est a la racine du dossier principal
				//if($path==$dossier)
				if(!isset($dossier) || $dossier=="." || $dossier=="")
				{
					
					//si ont doit generer les miniatures
					if($generer==1 )
					{						

						//on affiche un message d'erreur si la miniature n'a pas pu etre générée
						if($thumb=="faux")
						{
							
							echo "\n<td width=\"$width%\" > <a href=\"".$dir[$i]."\" target=\"blank\">(pas de miniature)<br /> ".rawurldecode($dir[$i])."</a>";
						}
						//sinon, on affiche la miniature
						else
						{
							echo "\n<td width=\"$width%\" > <a href=\"".$dir[$i]."\" target=\"blank\"><img src=\"_thumb_".$dir[$i].".thumb\" border=\"0\"><br />".rawurldecode($dir[$i])."</a>";
						}
						$thumb='rien';											
					}
					//on genere la miniature à la volé
					else
					{
						echo "\n<td width=\"$width%\" ><a href=\"./".$dir[$i]."\" target=\"blank\"><img src=\"".$nom_page."?act=thumb&img=".$dir[$i].$variable_url."\" border=\"0\"><br />".rawurldecode($dir[$i])."</a>";
					}
				}
				//sinon, si on est pas a la racine de la galerie
				else
				{
					//si ont doit generer les miniatures
					if($generer==1 )
					{						

						//on affiche un message d'erreur si la miniature n'a pas pu etre générée
						if($thumb=="faux")
						{
							echo "\n<td width=\"$width%\" ><a href=\"./".$dossier."/".$dir[$i]."\" target=\"blank\">(pas de miniature)<br /> ".rawurldecode($dir[$i])."</a>";
						}
						//sinon, on affiche la miniature
						else
						{
							echo "\n<td width=\"$width%\" ><a href=\"./".$dossier."/".$dir[$i]."\" target=\"blank\"><img src=\"".$dossier."/_thumb_".$dir[$i].".thumb\" border=\"0\"><br />".rawurldecode($dir[$i])."</a>";
						}
						$thumb='rien';											
					}
					//on genere la miniature à la volé
					else
					{
						//echo "\n<td width=\"$width%\" ><a href=\"./".$dossier."/".$dir[$i]."\" target=\"blank\"><img src=\"".$path."/".$nom_page."?act=thumb&img=".$dir[$i].$variable_url."\" border=\"0\"></a><br />".rawurldecode($dir[$i]);
						echo "\n<td width=\"$width%\" ><a href=\"".$dossier."/".$dir[$i]."\" target=\"blank\"><img src=\"".$nom_page."?act=thumb&img=".$dossier."/".$dir[$i].$variable_url."\" border=\"0\"><br />".rawurldecode($dir[$i])."</a>";
					
					}

						
				}
				
				if($admin==1)
				{
					echo"<br /> <a href=\"?act=supprimer&dossier=".$dossier."&img=$dir[$i]".$variable_url."\">supprimer</a>";
					echo"<br /> <a href=\"?act=renommer&dossier=".$dossier."&img=$dir[$i]".$variable_url."\">renommer</a>";
				}
				
				echo"</td>";
				
			}
		}
		else
		{
			echo "\n<td width=\"$width%\">&nbsp;...</td>";
		}
		$i++;
		
		if($i%$nb_colone==0 &&$i!=0)
		{
			if($i<$num)
			echo "\n</tr>\n<tr bgcolor=\"$couleur\">";
			else
			echo "\n</tr>";
			$nb_ligne++;
		}		
	}
	echo"</table>";
}


function afficher_formulaire_upload()
{
		
	echo'<div style="background:#C0C0C0;width:30%;">
	<h4>Formulaire pour uploader une photo</h3>
	<form ENCTYPE="multipart/form-data" method="post" name="upload">	
	<input type="hidden" name="MAX_FILE_SIZE" value="9999999" />
	<input name="mdp" type="password"> password<br />
	<input name="NomFichier" type="file"><br />
	<input type="hidden" name="act" value="upload">
	<input type="SUBMIT" VALUE="Upload">
	<input type="reset" name="Cancel " value="Cancel ">
	</form> </div>';
	
	

}

function afficher_formulaire_recherche()
{
 global $dossier;
echo'<table align="center"><tr><td><form >	
	<input name="mot" type="text">
	<input type="SUBMIT" VALUE="rechercher une image">
	<input type="hidden" name="dossier" value="'.$dossier.'">
	</form></td></tr></table> ';

}

function upload()
{
	global $HTTP_HOST,$REQUEST_URI,$_FILES,$chemin,$dossier,$chemin_entier;
	if (file_exists($_FILES['NomFichier']['name']))
	{
		echo"<h3>un fichier comporte deja ce nom</h3>";
	}
	else
	{	
		
		if(move_uploaded_file($_FILES["NomFichier"]["tmp_name"],$chemin_entier.'/'.$_FILES["NomFichier"]["name"]))
		{
			
			
			$path=pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME);
			
			echo '<h3>"'.$_FILES['NomFichier']['name'].'" a été envoyé sur le serveur avec succées</h3>';
			echo '<p><a href="?dossier='.$dossier.$variable_url.'">retourner à la galerie</a><br /></p>';
			echo '<input type="text" size="72" value="[img]http://'.$_SERVER['HTTP_HOST'].''.$path.'/'.$dossier.'/'.$_FILES['NomFichier']['name'].'[/img]"><br /><br />';
			echo '<img src="http://'.$_SERVER['HTTP_HOST'].''.$path.'/'.$dossier.'/'.$_FILES['NomFichier']['name'].'">';
			
			
		}
		else
		{
		echo "<h3>upload echoué</h3><br />";
		}		
	}


}

function image_erreur($message)
{
	global $max_largeur,$max_longeur;
	$im = ImageCreate ($max_largeur, $max_longeur); /* Create a blank image */
    $bgc = ImageColorAllocate ($im, 200, 200, 200);
    $tc  = ImageColorAllocate ($im, 0, 0, 0);
    ImageFilledRectangle ($im, 0, 0, $max_largeur, $max_longeur, $bgc);
    /* Output an errmsg */
    ImageString($im, 2, 5, 5, $message, $tc);
	//ImageString($im, 2, 5, 15, $img, $tc); 
	return $im;

}


function thumb($img,$generer=0)
{

	global $gd,$max_largeur,$max_longeur,$generer;
	
	//on demande les dimension de l'image $img et son type d'image (png, jpg, gif)
	
	//si on n'arrive pas a voir la taille de l'image gande taille
	if(!$size = getimagesize($img))
	{
		$img_error=image_erreur("erreur: taille inconnu");
		
		if($generer==0)
		{
			
			//on affiche l'image d'erreur
			header("Content-type: image/jpg"); 
			$img_big = imagejpeg($img_error);
			exit();
			
		}
		else
		{
			//on signale qu'il y a une erreur en mettant les variables a zero
			
			//largeur
			$largeur=100;
			$size[0]=100;
			//longeur
			$longeur=100;
			$size[1]=100;
			//on regarde si c'est png jpg gif
			$type=0;	
			//return "faux";
		}
		
	}
	else
	{
		//on regarde si c'est png jpg gif
		$type=$size[2];		
		
		switch($type)
		{

				
			case 2: if(!$img_big =imagecreatefromjpeg($img)){ $img_big=$img_error;}  break;
			case 3: if(!$img_big =imagecreatefrompng($img)) { $img_big=$img_error; } break;
			case 1: if(!$img_big =imagecreatefromgif($img)) { $img_big=$img_error; } break;
		}	

		//largeur
		$largeur=$size[0];
		//longeur
		$longeur=$size[1];

		//on charge l'image $img dans $img_big:	
	}
	

	//on regarde si l'image depasse en longueur
	$depasse_long=$longeur-$max_longeur;
	//on regarde si l'image depasse en largeur
	$depasse_large=$largeur-$max_largeur;
	
	
	//si l'image est + grande que les tailles max ou bien s'il faut generer les images
	if($depasse_long>0 || $depasse_large>0 || $generer==1)
	{
		
		if($depasse_long>$depasse_large)
		{		
			$largeur=($max_longeur/$longeur)*$largeur;
			//echo "$largeur=$max_longeur/$longeur)*$largeur";
			//echo 'longueur:'.$longeur;
			$longeur=$max_longeur;
			//150/243*300
		}
		else
		{
			$longeur=($max_largeur/$largeur)*$longeur;
			//echo 'largeur:'.$largeur;
			//echo '<br />$longeur:'.$longeur;
			$largeur=$max_largeur;	
		}
		
		//echo $size[0]." X ".$size[1].";( $largeur x $longeur)";
		
		
		//on fait une nouvelle image ayant pour dimension: largeur et hauteur
		if($gd=="1")
		{
			$img_mini = imagecreate($largeur,$longeur);
			
		}
		
		else
		{
			$img_mini = imagecreatetruecolor($largeur,$longeur); 
			
		}
		
		
		if($type==0)
		{		
			$type='2';
			$img_big=$img_error;			
		}
	
		//on copie l'image d'origine contenu dans img_big dans img_mini en la reduisant a $largeur pour la largeur et $longeur pour la hauteur:
		//imagecopyresized($img_mini,$img_big,0,0,0,0,$largeur,$longeur,$size[0],$size[1]);
		imagecopyresampled($img_mini,$img_big,0,0,0,0,$largeur,$longeur,$size[0],$size[1]);
		switch($type)
		{
			//si c'est une image jpg
			case 2: 
			//si on genere les miniatures sur le dd
			if($generer==1)
			{
				imagejpeg($img_mini,'_thumb_'.$img.'.thumb'); 
				
			
			}
			else
			{			
				//on enverra au navigateur un fichier de type image au format jpeg
				header("Content-type: image/jpeg");
				//on envoie l'image reduire au navigateur:
				imagejpeg($img_mini); 
				
			}
			
			break;

			case 3:
			if($generer==1)
			{
				imagepng($img_mini,'_thumb_'.$img.'.thumb'); 
				
			
			}
			else
			{
				//on enverra au navigateur un fichier de type image au format png
				header("Content-type: image/png");
				//on envoie l'image reduire au navigateur:
				imagepng($img_mini); 
				
			}
			

			break;

			case 1: 
			
			if($generer==1)
			{
				imagegif($img_mini,'_thumb_'.$img.'.thumb'); 
				
			
			}
			else
			{			
				//on enverra au navigateur un fichier de type image au format gif
				header("Content-type: image/gif");
				//on envoie l'image reduire au navigateur:
				imagegif($img_mini);
				
			}

			break;

			
		}
	

	}

	else
	{
		
		switch($type)
		{
			case 2:header("Content-type: image/jpg"); $img_big = imagejpeg($img_big); break;

			case 3:header("Content-type: image/png"); $img_big = imagepng($img_big); break;

			case 1:header("Content-type: image/gif"); $img_big = imagegif($img_big);break;

			

		}		
	}
	
	return "vrai";
}


function tableau_html($dir,$nb_colone,$couleur1,$couleur2)//"#F0F0F0","#E4E4E4"
{	
	global $admin,$path,$HTTP_HOST,$REQUEST_URI;
	
	$num=count($dir);
	
 	$i=0;
	
	$tableau = "\n<table border=\"0\" width=\"90%\" align=\"center\"><tr bgcolor=\"$couleur1\">";
	$width=100/$nb_colone;
	$nb_ligne=0;
	while($i<$num || $i%$nb_colone!=0)
	{	
		if($nb_ligne%2==0) {$couleur=$couleur2;} else {$couleur=$couleur1;};
		
		
		if($i<$num)
		{
				$tableau .=  "\n<td width=\"$width%\" >";
				$tableau .= $dir[$i];
				$tableau .= "</td>";
		}
		else
		{
			$tableau .= "\n<td width=\"$width%\">&nbsp;</td>";
		}
		$i++;
		
		if($i%$nb_colone==0 &&$i!=0)
		{
			if($i<$num)
			$tableau .= "\n</tr>\n<tr bgcolor=\"$couleur\">";
			else
			$tableau .= "\n</tr>";
			$nb_ligne++;
		}		
	}
	$tableau .= "</table>";
	
	return $tableau;
}

function copyright()
{
	global $version;
	//merci de ne pas enlever cette ligne
	echo "<p align=\"center\">Version: ".$version."<br />
	Téléchargez cette galerie gratuite sur <a href=\"http://www.indexof.fr\" target=\"_blank\">indexof.fr</a></p>";
	

}

?>