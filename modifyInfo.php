<?php
	session_start();
	//connection au serveur:
	$BDD= mysql_connect('localhost','root','');
	 //sélection de la base de données:
	mysql_select_db('comparessence');

	include("boutonDeco.php");
?>

<?php
	
if(isset($_POST["valid"]))
{
	$brand = $_POST["marque"];
	$fuel = $_POST["carburant"];
	$civility= $_POST["civility"];
	$city = $_POST["city"];
	$number = $_POST["number"];
	$categorie = $_POST["categorie"];
	
	$pseudo = $_SESSION['pseudo'];
	
	if($brand != NULL || $fuel != NULL || $civility != NULL || $city != NULL || $number != NULL || $categorie != NULL)
	{	
		
		$getID = "SELECT id FROM membres WHERE pseudo = '".$pseudo."'";
		$getID = mysql_query($getID);
		
		while($data=mysql_fetch_array($getID))
		{
			$idMembre = $data['id'];
		}
		echo $idMembre;
		
		
			
		// on vérifie si le membre à déja personnalisé son profil (sinon la table est vide)
		$request = mysql_query("SELECT idMembre FROM preferences WHERE idMembre = ".$idMembre."");
		$num = mysql_num_rows($request);
		
		if($num == 0)
		{
			$result = "INSERT INTO preferences (idMembre, marque, carburant, civilite, ville, nombreVehicule, categorieSP) VALUES (".$idMembre.", '".$brand."', '".$fuel."', '".$civility."', '".$city."', '".$number."', '".$categorie."')";
			$result = mysql_query($result);
		}
		elseif($num == 1)
		{
			if($brand == ""){} else{ mysql_query("UPDATE preferences SET marque='".$brand."'");}
			if($fuel == ""){} else{ mysql_query("UPDATE preferences SET carburant='".$fuel."'");}
			if($civility == ""){} else{ mysql_query("UPDATE preferences SET civilite='".$civility."'");}
			if($city == ""){} else{ mysql_query("UPDATE preferences SET ville='".$city."'");}
			if($number == ""){} else{ mysql_query("UPDATE preferences SET nombreVehicule='".$number."'");}
			if($categorie == ""){} else{ mysql_query("UPDATE preferences SET categorie='".$categorie."'");}
			
		}
		
		$sql = "SELECT * FROM preferences WHERE idMembre = ".$idMembre;
		$sql = mysql_query($sql);
		
		while($data2=mysql_fetch_array($sql))
		{
			$marque = $data2['marque'];
			$carburant = $data2['carburant'];
			$civilite = $data2['civilite'];
			$ville = $data2['ville'];
			$nombreVehicule = $data2['nombreVehicule'];
			$categorieSP = $data2['categorieSP'];
		}
	}
	

}
   
?>

<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<title>Compte Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>


<div class='form'>
<form method="POST" action="modifyInfo.php">

<h1>Modifier vos informations personnelles</h1>
<div class='input'>
<p>
<label for='marque'>Votre marque</label>
<?php
	if(isset($brand)) { echo '<select name="marque" value="'.$brand.'">
		<option></option>
		<option>Auchan</option>
		<option>Avia</option>
		<option>BP</option>
		<option>Carrefour</option>
		<option>Carrefour Market</option>
		<option>Casino</option>
		<option>Elf</option>
		<option>Esso</option>
		<option>Esso Express</option>
		<option>Intermarche</option>
		<option>Leclerc</option>
		<option>Oil France</option>
		<option>Shell</option>
		<option>Simply Market</option>
		<option>Super U</option>
		<option>Total</option>
		<option>Total Access</option>
		
		</select>'; }
		
	else { echo '<select name="marque" value="">
		<option></option>
		<option>Auchan</option>
		<option>Avia</option>
		<option>BP</option>
		<option>Carrefour</option>
		<option>Carrefour Market</option>
		<option>Casino</option>
		<option>Elf</option>
		<option>Esso</option>
		<option>Esso Express</option>
		<option>Intermarche</option>
		<option>Leclerc</option>
		<option>Oil France</option>
		<option>Shell</option>
		<option>Simply Market</option>
		<option>Super U</option>
		<option>Total</option>
		<option>Total Access</option>
		
		</select>'; }
?>
</p>
</div>

<div class='input'>
<p>
<label for='carburant'>Votre carburant</label>
<?php
	if(isset($fuel)) { echo '<select name="carburant" value="'.$fuel.'">
	
		<option></option>
		<option>Gazole</option>
		<option>Gazole Premium</option>
		<option>GPL</option>
		<option>SP95-E10</option>
		<option>SP98</option>
		</select>'; }
		
	else { echo '<select name="carburant" value=""> 
		
		<option></option>
		<option>Gazole</option>
		<option>Gazole Premium</option>
		<option>GPL</option>
		<option>SP95-E10</option>
		<option>SP98</option>
		</select>'; }
?>

</p>
</div>

<div class='input'>
<p>
<label for='civility'>Votre civilité</label>
<?php
	if(isset($prenom)) { echo '<select name="civility" value="'.$civilite.'">
		<option></option>
		<option>Homme</option>
		<option>Femme</option>
		</select>'; }
	else { echo '<select name="civility" value="">
		<option></option>
		<option>Homme</option>
		<option>Femme</option>
		</select>'; }
?>
</p>
</div>

<div class='input'>
<p>
<label for='city'>Votre ville</label>
<?php 
	if(isset($ville)) { echo '<input type="text" maxlength="20" name="city" value="'.$ville.'" >'; }
	else { echo '<input type="text" maxlength="20" name="city" value="" >'; }
?>
</p>
</div>

<div class='input'>
<p>
<label for='number'>Nombre de véhicules</label>
<?php
	if(isset($nombreVehicule)) { echo '<select name="number" value="'.$nombreVehicule.'">
		<option></option>
		<option>Aucun</option>
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>Plus de 4</option>
		</select>'; }
		
	else { echo '<select name="number" value="">
		<option></option>
		<option>Aucun</option>
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>Plus de 4</option>
		</select>'; }

?>
</p>
</div>

<div class='input'>
<p>
<label for='categorie'>Catégorie SP</label>
<?php
	if(isset($nombreVehicule)) { echo '<select name="categorie" value="'.$categorieSP.'">
		<option></option>
		<option>Etudiant</option>
		<option>Employé du secteur public</option>
		<option>Employé du secteur public</option>
		<option>Cadre/Ingénieur</option>
		<option>Sans profession</option>
		<option>Retraité</option>
		<option>Autre</option>
		</select>'; }
		
	else { echo '<select name="categorie" value="">
		<option></option>
		<option>Etudiant</option>
		<option>Employé du secteur public</option>
		<option>Employé du secteur public</option>
		<option>Cadre/Ingénieur</option>
		<option>Sans profession</option>
		<option>Retraité</option>
		<option>Autre</option>
		</select>'; }
?>
</p>
</div>
<input type="submit" name="valid" value="Enregistrer">
</form></div>
<?php mysql_close($BDD); ?>
</body></html>