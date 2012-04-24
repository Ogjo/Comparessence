<?php
/*
Thomas Rempenault
Créé le : 10/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page où la saisie de la ville par l'utilisateur est vérifiée et où les différentes possibilités de villes sont affichées
*/
	session_start();
	include("boutonDeco.php");
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('france');
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
	if(isset($_POST['city']))
	{
		$city=$_POST['city'];
		searchCity($city);
				
		$num = mysql_num_rows($_SESSION['searchCity']);
		echo "<div class='form'>";
		// s'il y a un ou plusieurs résultats ou que l'orthographe est incomplète, on affiche les différentes possibilités
		if($num>0)
		{
			// si l'utilisateur vient de la page Ajouter une station, on le renvoie vers cette page
			if(isset($_POST['validAdd']))
			{
				echo "<form method='POST' action='addStation.php'>";
				while($data=mysql_fetch_array($_SESSION['searchCity'])) {
					echo "<input type='radio' name='selCity' value='".$data['nom_ville_url']."'>".strtoupper($data['nom_ville_url'])." (".$data['code_postal'].")<br/>";
				}
				echo "<br/><input type='submit' name='validSelect' value='Sélectionner la ville'>";
				echo "</form></div>";
			}
			// si l'utilisateur vient de la page Renseigner un prix, on le renvoie vers cette page
			elseif(isset($_POST['validFill']))
			{
				echo "<form method='POST' action='renseignerPrix.php'>";
				while($data=mysql_fetch_array($_SESSION['searchCity'])) {
					echo "<input type='radio' name='selCity' value='".$data['nom_ville_url']."'>".strtoupper($data['nom_ville_url'])." (".$data['code_postal'].")<br/>";
				}
				echo "<br/><input type='submit' name='validSelect' value='Sélectionner la ville'>";
				echo "</form></div>";
			}
		}
		else
		{
			echo "Aucune ville ne correspond à votre recherche.";
		}
		unset($_SESSION['searchCity']);
	}
	else { echo "Erreur champ vide"; }
	mysql_close($BDD);

?>

</div>
</body></html>