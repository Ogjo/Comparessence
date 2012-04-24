<?php
/*
Thomas Rempenault
Créé le : 09/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page où l'utilisateur renseigne la ville, puis la marque, l'adresse et le téléphone d'une station qu'il souhaite ajouter à la base de données
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
<title>Ajouter une station - Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php
	// on affiche un message si l'utilisateur sélectionne un lieu sans sélectionner de carburant
	if(isset($_SESSION['msgJS'])) {
		if($_SESSION['msgJS']==1) { ?>
		<SCRIPT language="Javascript"> alert("Veuillez saisir un code postal valide");</SCRIPT> 
<?php 	}
	}
	unset($_SESSION['msgJS']);
	
	if(isset($_SESSION['pseudo']))
	{
		if(isset($_POST['selCity'])) { $city=$_POST['selCity']; }

		// on demande à l'utilisateur de rentrer la ville de la station qu'il souhaite ajouter
		if(empty($_POST['selCity'])) { ?>
			<div class='form'>
			<form method="POST" action="checkSearch.php">
			<h1>Ajouter une station</h1>
			<div class='input'>
			<p><label style="width: 170px;" for='city'>Ville ou Code postal</label>
			<?php echo "<input type='text' name='city' value='' autofocus required>"; ?>
			<span>Vous devez entrer une ville ou un code postal</span>
			</p></div>
			
			<input type="submit" name="validAdd" value="Rechercher">
			</form></div>
<?php	}

		// il ajoute ensuite les informations de la station
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
				?>
				<div class='form'>
				<form method='POST' action='addStationFinal.php'>
				<h1>Ajouter une station</h1>
				<div class='input'>
				<p><label for='city'>Ville</label>
				<input type='text' name='city' disabled='disabled' value='<?php echo strtoupper($cityMaj); ?>'>
				</p></div>
				
				<div class='input'>
				<p><label for='cp'>Code Postal</label>
				<input type='text' name='cp' disabled='disabled' value='<?php echo $cp; ?>'>
				</p></div>
				
				<input type='hidden' name='cityMaj' value='<?php echo $cityMaj; ?>'>
				<input type='hidden' name='cp' value='<?php echo $cp; ?>'>
				<input type='hidden' name='dpt' value='<?php echo $dpt; ?>'>
				
				<div class='input'>
				<p><label for='brand'>Préciser la marque</label>
				<select name="brand" required>
				<option></option><option>Auchan</option><option>Avia</option><option>BP</option><option>Carrefour</option><option>Carrefour Market</option><option>Casino</option>
				<option>Elf</option><option>Esso</option><option>Esso Express</option><option>Intermarche</option><option>Leclerc</option><option>Oil France</option>
				<option>Shell</option><option>Simply Market</option><option>Super U</option><option>Total</option><option>Total Access</option></select>
				</p></div>
				
				<div class='input'>
				<p><label for='adress'>Adresse (facultatif)</label>
				<input type='text' name='adress' value=''>
				</p></div>
				
				<div class='input'>
				<p><label for='tel'>Téléphone (facultatif)</label>
				<input type='tel' name='tel' value=''>
				</p></div>
				
				<input type='submit' name='valid' value='Ajouter la station'>
				</form></div>
				<?php
				
			}
		}
	}
	else
	{ ?>
		<div class='form'><div align='center'>
		Vous devez être connecté au site pour pouvoir ajouter une station.<br/><br/>
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