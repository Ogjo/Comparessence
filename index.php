<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<title>Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("boutonDeco.php"); ?>
<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php 
	// on affiche un message si l'utilisateur vient de s'inscrire
	if(isset($_SESSION['registerOK'])) {
		if($_SESSION['registerOK'] == TRUE){ echo '<div class="ok"><div align="center">'.$_SESSION['registerMsg'].'</div></div>'; }
	}
	unset($_SESSION['registerOK']);

	// on affiche un message si l'utilisateur sélectionne un lieu sans sélectionner de carburant
	if(isset($_SESSION['msgJS']))
	{
		if($_SESSION['msgJS']==1) { ?>
		<SCRIPT language="Javascript"> alert("Veuillez choisir un type de carburant");</SCRIPT> 
	<?php }
		elseif($_SESSION['msgJS']==2) { ?>
		<SCRIPT language="Javascript"> alert("Veuillez saisir un code postal ou un département valide");</SCRIPT> 
	<?php }
	}
	unset($_SESSION['msgJS']);
?>		
<br/><br/><br/><br/>
<div class="col1" style="margin-left: 30px; padding: 20px 20px 20px 20px;">
<form method="GET" action="resultats.php">
Code postal / Département: <input type="text" maxlength="5" size="5" pattern="[0-9]*" name="cp" value="" autofocus required>
<table border=0 style="font-size: 1.0em;">
	<tr><td>Carburant:</td><td><input type="radio" name="fuel" id="gazole" value="go"><label for="gazole">Gazole</label></td></tr>
	<tr><td></td><td><input type="radio" name="fuel" id="goP" value="goP"><label for="goP">Gazole Premium</label></td></tr>
	<tr><td></td><td><input type="radio" name="fuel" id="sp95" value="sp95"><label for="sp95">SP95-E10</label></td></tr>
	<tr><td></td><td><input type="radio" name="fuel" id="sp98" value="sp98"><label for="sp98">SP98</label></td></tr>
	<tr><td></td><td><input type="radio" name="fuel" id="gpl" value="gpl"><label for="gpl">GPL</label></td></tr>
	<tr><td></td><td><input type="submit" name="valid" style="margin-left: 0px;" value="Trouver"></td></tr>
</table>
</form></div>


<img src="img/idfTrans.jpg" style="margin: -270px 0px 5px 400px; height: 400px;" alt="" /><br/>







</body></html>