<?php
/*
Thomas Rempenault
Créé le : 14/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page où l'utilisateur renseigne la ville, puis la marque de la station de laquelle il souhaite renseigner le prix
*/
	session_start();
	include("boutonDeco.php");
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('france');
?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<title>Renseigner un prix - Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php
	if(isset($_SESSION['pseudo']))
	{
		if(isset($_POST['selCity'])) { $city=$_POST['selCity']; }

		// on demande à l'utilisateur de rentrer la ville de la station dont il souhaite renseigner les prix
		if(empty($_POST['selCity']))
		{ ?>
			<div class='form'>
			<form method="POST" action="checkSearch.php">
			<h1>Renseigner un prix</h1>
			<div class='input'>
			<p><label style="width: 170px;" for='city'>Ville ou Code postal</label>
			<?php echo "<input type='text' name='city' value='' autofocus required>"; ?>
			<span>Vous devez entrer une ville ou un code postal</span>
			</p></div>
			
			<input type="submit" name="validFill" value="Rechercher">
			</form></div>
<?php	}
		// on récupère le nom de la ville, le code postal et le département de la table villes
		else
		{
			mysql_query("SET NAMES 'utf8'"); 
			$search = "SELECT * FROM villes WHERE nom_ville_url = '".$city."'";
			$search = mysql_query($search);
			$num = mysql_num_rows($search);
			
			if($num==0) { echo "Ville inexistante, veuillez contacter l'administrateur"; }
			elseif($num>0) {
				while($data=mysql_fetch_array($search)) {
					$cityMaj=$data['nom_ville_url'];
					$cp=$data['code_postal'];
					$dpt=$data['departement'];
				}
				
				// on change de base de données
				mysql_select_db('comparessence');
				
				// on affiche uniquement les stations de la ville sélectionnée par l'utilisateur
				$search2 = "SELECT DISTINCT marque FROM stations WHERE cp = '".$cp."'";
				$search2 = mysql_query($search2);
				$num2 = mysql_num_rows($search2);
				
				// si la ville ne possède pas de stations, on affiche un message
				if($num2==0) {
					$msg = "Aucune station n'est répertoriée dans cette ville";
					$msg2 = "Ajouter une station";
					echo "<div class='error'><div align='center'>".$msg."</div></div>";
					echo "<a href='addStation.php' class='boutonDeco' style='margin: 20px 0px 0px 400px; padding: 10px 5px 15px 5px; width: 200px; font-weight: bold;'>AJOUTER UNE STATION</a>";
				}
				elseif($num2>0) {
				
					// METTRE LES MSG ICI
					//echo "<div class='error'><div align='center'>".$msg."</div></div>"; }

					// on affiche à nouveau le formulaire
?>
					<div class='form'>
					<form method='POST' action='fillBrand.php'>
					<h1>Renseigner un prix</h1>
					<div class='input'>
					<p><label for='city'>Ville</label>
					<input type='text' name='city' disabled='disabled' value='<?php echo strtoupper($cityMaj); ?>'>
					</p></div>
					
					<div class='input'>
					<p><label for='cp'>Code Postal</label>
					<input type='text' name='cp' disabled='disabled' value='<?php echo $cp; ?>'>
					</p></div>
					
					<input type='hidden' name='cityMaj' value='<?php echo $cityMaj ?>'>
					<input type='hidden' name='cp' value='<?php echo $cp; ?>'>
					<input type='hidden' name='dpt' value='<?php echo $dpt; ?>'>
<?php				
					// on affiche les différentes marques de stations présentes dans la ville
					echo "<div class='input'>";
					echo "<p><label for='brand'>Préciser la marque</label>";
					echo "<select name='brand' required>";
					echo "<option></option>";
					while($data2=mysql_fetch_array($search2)) {
						echo "<option>".$data2['marque']."</option>";
					}
					echo "</select></p></div>";
					echo "<input type='submit' name='valid' value='Valider'>";
					echo "</form></div>";
				}
			}
		}
	}
	else
	{ ?>
		<div class='form'><div align='center'>
		Vous devez être connecté au site pour pouvoir renseigner un prix.<br/><br/>
		<form method='POST' action='connexion.php'>
		<input type='submit' style='margin-left: 0px; width: 120px;' name='valid' value='Se connecter'>
		</form>
		<form method='POST' action='inscription.php'>
		<input type='submit' style='margin-left: 0px; width: 120px;' name='valid' value="S'inscrire">
		</form></div></div>
<?php
	}
	mysql_close($BDD);
?>



</body></html>