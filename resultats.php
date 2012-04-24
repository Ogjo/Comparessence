<?php
/*
Thomas Rempenault
Créé le : 10/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page d'affichage des résultats de la recherche du prix de carburant en fonction du lieu saisi par l'utilisateur
*/
	session_start();
	include("boutonDeco.php");
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('comparessence');
	include("fonctions.php");
?>

<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<title>Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php
	// si l'utilisateur n'a pas sélectionné de carburant, on lui affiche un message
	if(empty($_GET['fuel'])) { 
		$_SESSION['msgJS'] = 1;
		header('Location: index.php');
	}
	if((strlen($_GET['cp']))==1 || (strlen($_GET['cp']))==3 || (strlen($_GET['cp']))==4) {
		$_SESSION['msgJS']= 2;
		header('Location: index.php');
	}
	
	if(empty($_GET['cp']) || empty($_GET['fuel']))
	{
		header('Location: index.php');
	}
	else
	{
		// on récupère les informations du formulaire de recherche
		$cp=$_GET['cp'];
		$fuel=$_GET['fuel'];
		
		if(isset($_GET['cp']) && isset($_GET['fuel']))
		{
			searchFuelPrice($cp, $fuel);
		}
?>

<h2>Recherche du prix du 
<?php	if($fuel=="go") { echo "Gazole"; } if($fuel=="goP") { echo "Gazole Premium"; } if($fuel=="sp95") { echo "Sans Plomb 95 - E10"; } if($fuel=="sp 98") { echo "Sans Plomb 98"; } if($fuel=="gpl") { echo "GPL"; } ?> 
dans les stations du <?php echo $cp; ?></h2>

<?php
	// on vérifie s'il y a des résultats 
		if(isset($_GET['cp']) && isset($_GET['fuel']))
		{
			$num = mysql_num_rows($_SESSION['search']);
			if($num==0)
			{
				echo "Pas de résultats";
			}
			else
			{
				// si oui, on les affiche
				while($data=mysql_fetch_array($_SESSION['search'])) {
					echo "<div class='affResults'>";
					if($fuel=="go"){ echo "<div class='affPrix'>".number_format($data['go'], 3, '.', ' ')." <div class='affPrix2'>€/L</div></div>"; }
					if($fuel=="goP"){ echo number_format($data['goP'], 3, '.', ' ')."<br/>"; }
					if($fuel=="sp95"){ echo number_format($data['sp95'], 3, '.', ' ')."<br/>"; }
					if($fuel=="sp98"){ echo number_format($data['sp98'], 3, '.', ' ')."<br/>"; }
					if($fuel=="gpl"){ echo number_format($data['gpl'], 3, '.', ' ')."<br/>"; } ?>
					<div style="margin: -15px 0px 0px 115px; padding-top: 5px;">
					<?php
					echo "<div class='affStation'>".$data['marque']."</div>";
					echo "<div class='affMaj'>";
					if($fuel=="go"){ echo "Mis à jour le ".$data['goDate']." par ".$data['pseudo']."<br/>"; }
					if($fuel=="goP"){ echo "Mis à jour le ".$data['goPDate']." par ".$data['pseudo']."<br/>"; }
					if($fuel=="sp95"){ echo "Mis à jour le ".$data['sp95Date']." par ".$data['pseudo']."<br/>"; }
					if($fuel=="sp98"){ echo "Mis à jour le ".$data['sp98Date']." par ".$data['pseudo']."<br/>"; }
					if($fuel=="gpl"){ echo "Mis à jour le ".$data['gplDate']." par ".$data['pseudo']."<br/>"; }
					echo "</div>";
					echo $data['adresse']."<br/>";
					echo $data['cp']." ";
					echo strtoupper($data['ville'])."</div></div><br/><br/>";
					echo "<div class='separate'></div><br/>";
				}
			}
		}
		unset($_SESSION['search']);
		mysql_close($BDD);
?>

<?php
	}
?>

</body></html>