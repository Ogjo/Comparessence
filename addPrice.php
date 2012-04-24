<?php
/*
Thomas Rempenault
Créé le : 22/04/2012
Modifié le : 23/04/2012 (Thomas Rempenault)
Page de vérification de la saisie du prix du carburant de la station, si les prix correspondent, ils sont mis à jour dans la base de données
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
		$go = $_POST['go'];
		$goP = $_POST['goP'];
		$sp95 = $_POST['sp95'];
		$sp98 = $_POST['sp98'];
		$gpl = $_POST['gpl'];
	}
	echo "";
?>



					
<?php
	mysql_close($BDD);
?>



</body></html>