<?php
	session_start();
	$BDD = mysql_connect("localhost","root","");
	mysql_select_db("comparessence");
	
	include("boutonDeco.php");
?>

<?php

// On met les variables utilisé dans le code PHP à FALSE (C'est-à-dire les désactiver pour le moment).
global $registerOK;
global $registerMsg;
$error = FALSE;
$registerOK = FALSE;

if(isset($_POST["validMember"]))
{
	$pseudo = $_POST["pseudo"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$email = $_POST["email"];
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	
	if($pseudo==NULL || $password==NULL || $password2==NULL || $email==NULL || $nom==NULL || $prenom==NULL)
	{
		$error=TRUE;
		$errorMsg = "Tous les champs doivent être remplis";
	}
	elseif($password==$password2)
	{
		if(strlen($password)>3 || strlen($pseudo)>3)
		{
			$password= md5($password);
			$password2= md5($password2);
			
			if($pseudo != $password)
			{
				// Pseudo déjà utilisé dans la base de données?
				$sql = "SELECT pseudo FROM membres WHERE pseudo = '".$pseudo."' ";
				$sql = mysql_query($sql);
				$sql = mysql_num_rows($sql);
				// Si $sql vaut 0, il n'y a pas d'entrée dans la table pour ce pseudo
				if($sql == 0)
				{
					// On inscrit l'utilisateur dans la base de données
					$request = "INSERT INTO membres (pseudo, nom, prenom, email, motDePasse) VALUES ('".$pseudo."','".$nom."','".$prenom."','".$email."','".$password."')";
					$request = mysql_query($request);
					   
					// Si la requête s'est bien effectué :
					if($request)
					{
						$registerOK = TRUE;
						$registerMsg = "Inscription réussie !";
						$_SESSION['registerOK']= $registerOK;
						$_SESSION['registerMsg']= $registerMsg;
						header('Location: index.php');
						
						
					} else $error=TRUE;
					$errorMsg = "Erreur dans la requête SQL";
				
				}else $error=TRUE;
				$errorMsg = "Le pseudo est déjà utilisé";
		
			} elseif($pseudo == $password){
				$error=TRUE;
				$errorMsg = "Le pseudo doit être différent du mot de passe";
			}
			
		}elseif(strlen($password)<4 || strlen($pseudo)<4) {
			$error=TRUE;
			$errorMsg = "Une longueur de 4 caractères minimum est requise";
		}
	}elseif($password!=$password2) {
		$error=TRUE;
		$errorMsg = "Les mots de passe ne sont pas identiques";
	}
}
?>
<?php
   mysql_close($BDD);
?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<title>Inscription Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<?php 
	// Affichage des erreurs :
	if($error == TRUE){ echo '<div class="error"><div align="center">'.$errorMsg.'</div></div>'; }
	if($registerOK == TRUE){ echo '<div class="ok"><div align="center">'.$registerMsg.'</div></div>'; }
?>

<div class='form'style="width:469px;">
<form method="POST" action="inscription.php">

<h1>Inscription</h1>
<div class='input'>
<p>
<label for='pseudo'>Pseudo</label>
<?php
	echo '<input type="text" maxlength="20" name="pseudo" value="" required>';
?>
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

<div class='input'>
<p>
<label for='password2'>Confirmez le mot de passe</label>
<?php 
	echo '<input type="password" maxlength="20" name="password2" value="" required>';
?>
<span>Vous devez confirmer votre mot de passe</span>
</p>
</div>

<div class='input'>
<p>
<label for='nom'>Nom</label>
<?php 
	echo '<input type="text" maxlength="20" name="nom" value="" required>';
?>
<span>Vous devez entrer votre Nom</span>
</p>
</div>

<div class='input'>
<p>
<label for='prenom'>Prénom</label>
<?php 
	echo '<input type="text" maxlength="20" name="prenom" value="" required>';
?>
<span>Vous devez entrer votre Prénom</span>
</p>
</div>

<div class='input'>
<p>
<label for='email'>Email</label>
<?php echo '<input type="email" maxlength="30" name="email" value="" required>'; ?>
<span>Vous devez entrer votre Email</span>
</p>
</div>
<input type="submit" name="validMember" value="S'inscrire">
</form></div>



</body></html>