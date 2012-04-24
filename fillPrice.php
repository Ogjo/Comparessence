<?php
/*
Thomas Rempenault
Créé le : 17/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page où l'utilisateur renseigne les prix des carburants de la station sélectionée
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
	if(isset($_POST['selStation'])) {
		$city=$_POST['cityMaj'];
		$cp=$_POST['cp'];
		$dpt=$_POST['dpt'];
		$brand = $_POST['brand'];
		$station = $_POST['selStation'];
	}
?>

	<div class='form'>
	<form method='POST' action='fillPriceBrand.php'>
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
	
	<div class='input'>
	<p><label for='station'>Adresse</label>
	<input type='text' name='station' disabled='disabled' value='<?php echo $station; ?>'>
	</p></div>
	
	<input type='hidden' name='cityMaj' value='<?php echo $city; ?>'>
	<input type='hidden' name='cp' value='<?php echo $cp; ?>'>
	<input type='hidden' name='dpt' value='<?php echo $dpt; ?>'>
	<input type='hidden' name='brand' value='<?php echo $brand; ?>'>
	<input type='hidden' name='station' value='<?php echo $station; ?>'>
	
	<div class='input'>
	<p><label for='go'>Prix du Gazole</label>
	<input type='text' name='go' value=''>€/L
	</p></div>
	<div class='input'>
	<p><label for='goP'>Prix du Gazole Premium</label>
	<input type='text' name='goP' value=''>€/L
	</p></div>
	<div class='input'>
	<p><label for='sp95'>Prix du SP95</label>
	<input type='text' name='sp95' value=''>€/L
	</p></div>
	<div class='input'>
	<p><label for='sp98'>Prix du SP98</label>
	<input type='text' name='sp98' value=''>€/L
	</p></div>
	<div class='input'>
	<p><label for='gpl'>Prix du GPL</label>
	<input type='text' name='gpl' value=''>€/L
	</p></div>
	
	<input type='submit' name='valid' value='Valider'>
	</form></div>
					
<?php
	mysql_close($BDD);
?>



</body></html>