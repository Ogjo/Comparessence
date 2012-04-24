<?php
	session_start();
	$BDD= mysql_connect('localhost','root','');
	mysql_select_db('comparessence');

	include("boutonDeco.php");
	
	// appel de la fonction checkLogin
	include("fonctions.php");
	if(isset($_POST['pseudo'])) {
		$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];
		checkLogin($pseudo, $password);
	}
	
?>
<?php
   mysql_close($BDD);
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
	// Affichage des erreurs :
	if(isset($_POST['pseudo'])) {
		if($error == TRUE){ echo '<div class="error"><div align="center">'.$errorMsg.'</div></div>'; }
		if($registerOK == TRUE){ echo '<div class="ok"><div align="center">'.$registerOK.'</div></div>'; }
	}
?>

<div class='form'>
<form method="POST" action="connexion.php">
<h1> Connexion </h1>
<div class='input'>
<p>
<label for='pseudo'>Pseudo</label>
<input type="text" maxlength="20" name="pseudo" value="<?php if (isset($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" required>
<span>Vous devez entrer un Pseudo</span>
</p>
</div>

<div class='input'>
<p>
<label for='password'>Mot de passe</label>
<?php
	echo '<input type="password" maxlength="20" name="password" value="" required>';
?>
<span>Vous devez entrer un mot de passe</span>
</p>
</div>
<p><a href="">Mot de passe oublié ?</a></p>
<input type="submit" name="valid" value="Se connecter">
</form>
</div>

</body></html>