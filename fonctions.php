<?php
/*
Joris Oger, Stephane Gereme
Créé le : 10/04/2012
Modifié le : 16/04/2012 (Thomas Rempenault)
Fonction qui permet de se connecter à son compte de Comparessence
Paramètres entrée : Pseudo, mot de passe
Paramètre sortie : Pseudo
*/

function checkLogin($pseudo, $password)
{
	global $error;
	global $errorMsg;
	global $registerOK;
	global $registerMsg;
	$error = FALSE;
	
	// on teste si les champs sont vides
	if($pseudo==NULL || $password==NULL)
	{
		$error=TRUE;
		$errorMsg = "Tous les champs doivent être remplis";
	}
	// on consulte la base de données pour voir si les informations correspondent
	elseif($pseudo && $password)
	{		
		$password= md5($password);
		$connect = "SELECT pseudo, motDePasse FROM membres WHERE pseudo = '".$pseudo."' AND motDePasse='".$password."' ";
		$connect = mysql_query($connect);
		$connect = mysql_num_rows($connect);
		
		if($connect == 0)
		{
			$error=TRUE;
			$errorMsg = "Pseudo ou mot de passe incorrect";
		}
		else
		{
			$_SESSION['pseudo'] = $pseudo;
			header('Location: index.php');
		}	
	}
}

/*
Thomas Rempenault
Créé le : 13/04/2012
Modifié le : 17/04/2012 (Thomas Rempenault)
Fonction qui permet d'afficher les prix du carburant sélectionné en fonction du lieu choisi par l'utilisateur
Paramètres entrée : Code postal (ou département), type de carburant
Paramètre sortie : recherche dans la base de données
*/
function searchFuelPrice($cp, $fuel)
{
	// on différencie le code postal du département en fonction de la longueur de la saisie
	if(strlen($cp)==2){ $choice="dpt"; }
	if(strlen($cp)==5){ $choice="cp"; }
	
	// on vérifie que la saisie comporte soit 2 soit 5 chiffres uniquement
	if(strlen($cp)!=2 && strlen($cp)!=5)
	{
		header('Location: index.php');
		// METTRE JAVASCRIPT 2 OU 5 CHIFFRES UNIQUEMENT
	}
	elseif(strlen($cp)==2 OR strlen($cp)==5)
	{
		// on va chercher les infos dans les tables stations et essence pour les prix en fonction de la saisie et du carburant
		if($fuel=="go"){ $search = "SELECT * FROM essence A JOIN stations B ON A.idStation=B.idStation JOIN membres C ON B.idMembre=C.id WHERE ".$choice."=".$cp." AND go=".$fuel." ORDER BY go"; }
		if($fuel=="goP"){ $search = "SELECT * FROM essence A JOIN stations B ON A.idStation=B.idStation JOIN membres C ON B.idMembre=C.id WHERE ".$choice."=".$cp." AND goP=".$fuel." ORDER BY goP"; }
		if($fuel=="sp95"){ $search = "SELECT * FROM essence A JOIN stations B ON A.idStation=B.idStation JOIN membres C ON B.idMembre=C.id WHERE ".$choice."=".$cp." AND sp95=".$fuel." ORDER BY sp95"; }
		if($fuel=="sp98"){ $search = "SELECT * FROM essence A JOIN stations B ON A.idStation=B.idStation JOIN membres C ON B.idMembre=C.id WHERE ".$choice."=".$cp." AND sp98=".$fuel." ORDER BY sp98"; }
		if($fuel=="gpl"){ $search = "SELECT * FROM essence A JOIN stations B ON A.idStation=B.idStation JOIN membres C ON B.idMembre=C.id WHERE ".$choice."=".$cp." AND gpl=".$fuel." ORDER BY gpl"; }
		$search = mysql_query($search);
		$_SESSION['search']=$search;
	}
}

/*
Thomas Rempenault
Créé le : 17/04/2012
Modifié le : 19/04/2012 (Thomas Rempenault)
Fonction qui permet de rechercher une ville ou un code postal à partir d'une saisie utilisateur
Paramètres entrée : ville (ou code postal)
Paramètre sortie : recherche dans la base de données
*/
function searchCity($city)
{
	// on vérifie si la saisie est un nombre (code postal) ou des lettres (nom de ville)
	if(is_numeric($city)) {
		// on vérifie si la saisie du code postal est différente de 5 chiffres
		if((strlen($city))!=5) {
			$_SESSION['msgJS'] = 1;
			header('Location: addStation.php');
		}
		elseif((strlen($city))==5) {
			$search = "SELECT nom_ville_url, code_postal FROM villes WHERE code_postal = ".$city;
			$search = mysql_query($search);
			$_SESSION['searchCity']=$search;
		}
	}
	else {
		// on regarde dans la base de données des villes de France si sa saisie correspond à une ville
		$city2=str_replace(' ', '-', $city);
		
		$search = "SELECT nom_ville_url, code_postal FROM villes WHERE nom_ville_url LIKE '%".$city2."%'";
		$search = mysql_query($search);
		$_SESSION['searchCity']=$search;
	}
			
}



?>








