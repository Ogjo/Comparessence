<?php
/*
Thomas Rempenault
Créé le : 16/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page de vérification du nombre de stations dans la ville sélectionnée par l'utilisateur, s'il y en a plusieurs, un choix entre celles-ci doit être effectué
*/
	session_start();
	include("boutonDeco.php");
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('comparessence');
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
	if(isset($_POST['brand'])) {
		$city=$_POST['cityMaj'];
		$cp=$_POST['cp'];
		$dpt=$_POST['dpt'];
		$brand = $_POST['brand'];
	}
	
	// on vérifie qu'il n'y ait pas plusieurs stations de la même marque dans la même ville
	$search = "SELECT * FROM stations WHERE marque = '".$brand."'";
	$search = mysql_query($search);
	$num = mysql_num_rows($search);
?>
	<div class='form'>
	<form method='POST' action='fillPrice.php'>
	<h1>Renseigner un prix</h1>
	<div class='input'>
	<p><label for='city'>Ville</label>
	<input type='text' name='city' disabled='disabled' value='<?php echo strtoupper($city); ?>'>
	</p></div>
	
	<div class='input'>
	<p><label for='cp'>Code Postal</label>
	<input type='text' name='cp' disabled='disabled' value='<?php echo $cp; ?>'>
	</p></div>
	
	<div class='input'>
	<p><label for='brand'>Marque</label>
	<input type='text' name='brand' disabled='disabled' value='<?php echo $brand; ?>'>
	</p></div>
	
	<input type='hidden' name='cityMaj' value='<?php echo $city; ?>'>
	<input type='hidden' name='cp' value='<?php echo $cp; ?>'>
	<input type='hidden' name='dpt' value='<?php echo $dpt; ?>'>
	<input type='hidden' name='brand' value='<?php echo $brand; ?>'>
<?php					
	echo "<div class='input'>";
	echo "<p><label for='brand'>Adresse</label>";
	
	// si il y a une seule marque dans la ville, on sélectionne par défaut le bouton radio
	if($num==1) {
		while($data=mysql_fetch_array($search)) {
			echo "<input type='radio' checked='checked;' name='selStation' value='".$data['adresse']."'>".$data['adresse']."";
	}
	echo "<br/><br/>";
	}
	
	// s'il y a plusieurs marques dans la même ville, on ne sélectionne rien par défaut
	elseif($num>1) {
		while($data=mysql_fetch_array($search)) {
			echo "<input type='radio' name='selStation' value='".$data['adresse']."'>".$data['adresse']."<br/>";
		}
		echo "<br/><br/>";
	}
	echo "</p></div>";
?>					
	<input type='submit' style='margin-left: 170px;' name='valid' value='Valider'>
	</form></div>
	
<?php
	mysql_close($BDD);
?>



</body></html>