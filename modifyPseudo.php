<?php
	session_start();
	include("boutonDeco.php");

?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="designRenseigner.css">
<title>Compte Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>


<div class='form'>
<form method="POST" action="modifyPseudo.php">

<h1>Modifier vos informations personnelles</h1>
<div class='input'>
<p>
<label for='name'>Votre nouveau pseudo</label>
<?php
	echo '<input type="text" maxlength="20" name="pseudo" value="" >';
?>
</p>
</div>

<input type="submit" name="valid" value="Enregistrer">
</form></div>



</body></html>