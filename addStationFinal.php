<?php
/*
Thomas Rempenault
Créé le : 11/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page de vérification de la saisie de la station, si elle n'existe pas, elle est ajoutée à la base de données
*/
	session_start();
	include("boutonDeco.php");
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('comparessence');
	include("fonctions.php");
	
	// on récupère les informations du formulaire
	if(isset($_POST['cityMaj']) && isset($_POST['cp']))
	{
		$city=$_POST['cityMaj'];
		$cp=$_POST['cp'];
		$dpt=$_POST['dpt'];
		$brand=$_POST['brand'];
		$adress=$_POST['adress'];
		$tel=$_POST['tel'];
		
		// on récupère l'id du membre qui ajoute la station
		$pseudo = $_SESSION['pseudo'];
		$getID = "SELECT id FROM membres WHERE pseudo = '".$pseudo."'";
		$getID = mysql_query($getID);
		$num3 = mysql_num_rows($getID);
		
		// si un seul id de membre est trouvé, tout va bien, sinon il y a un erreur au niveau des membres
		if($num3==1) {
			while($data=mysql_fetch_array($getID)) {
				$id = $data['id'];
			}
			
			// on vérifie si la station n'existe pas déjà
			$search = "SELECT adresse, cp FROM stations WHERE adresse LIKE '%".$adress."%' AND cp=".$cp;
			$search = mysql_query($search);
			$num = mysql_num_rows($search);
			if($num==0)
			{
				// si elle n'existe pas, on l'ajoute dans la base de données
				$add = "INSERT INTO stations (marque, ville, cp, dpt, adresse, telephone, idMembre) VALUES ('".$brand."', '".$city."', ".$cp.", ".$dpt.", '".$adress."', '".$tel."', ".$id.")";
				$add = mysql_query($add);
				$msg = "La station a été ajoutée, merci de votre contribution.";
			}
			else
			{
				$msg = "La station est déjà existante sur le site";
			}
		}
		else { $msg = "Erreur d'idMembre, veuillez contacter l'administrateur"; }
	}
?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<title>Ajouter une station - Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php
	if($num3!=1) { echo "<div class='error'><div align='center'>".$msg."</div></div>"; }
	else {
		if($num==0) { echo "<div class='ok'><div align='center'>".$msg."</div></div>"; }
		else { echo "<div class='error'><div align='center'>".$msg."</div></div>"; }
	}
?>

<div class='form'>
<?php
	if(isset($_POST['cityMaj']) && isset($_POST['cp']))
	{
			echo "Ville: ".strtoupper($city)."<br/>";
			echo "Code postal: ".$cp."<br/>";
			echo "Département: ".$dpt."<br/>";
			echo "Marque: ".$brand."<br/>";
			echo "Adresse: ".$adress."<br/>";
			echo "Téléphone: ".$tel."<br/>";
	}
	mysql_close($BDD);

?>
</div>


</body></html>