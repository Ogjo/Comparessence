<?php
	session_start();
	include("boutonDeco.php");

if(!empty($_FILES))
{
	$maxsize = '10000000';	// taille max autorisée
	$img = $_FILES['img'];
	$ext = strtolower(substr($img['name'],-3));	// met l'extension en minuscule
	$valid_extensions = array('jpg','png','gif');
	if(in_array($ext,$valid_extensions)){
		move_uploaded_file($img['tmp_name'],"images_avatar/".$img['name']);	// déplace l'image dans le dossier images
		
	}	
	else{
		$erreur = "Vous devez uploader un fichier jpg, png ou gif";
	}

}
?><!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="designRenseigner.css">
<title>Compte Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>


<div class='form'>
<form method="POST" action="modifyAvatar.php" enctype="multipart/form-data">

<h1>Modifier mon Avatar</h1>
<div class='input'>
<p>
<?php
if (isset($erreur)){
	echo $erreur;
}
echo'
<form method="POST" action="modifyAvatar.php" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="100000">';	 // On limite le fichier à 100Ko
   echo' <input type="file" name="img"/>
     <input type="submit" name="valid" value="Envoyer le fichier">';
	 ?>
</p>
</div>



</form></div>



</body></html>