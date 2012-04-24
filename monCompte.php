<?php
	session_start();
	include("boutonDeco.php");

?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="designInscription.css">
<title>Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<div class='form' >
<h1>Mon compte</h1>
<div align="center">
<form method="GET" action="modifyInfo.php">
<div class='input'>
<p><input type='submit' value='modifier info' name='submit' style="margin-left:0px;"></p>
</div>
</form>

<form method="GET" action="modifyAvatar.php">
<div class='input'>
<p><input type='submit' value='Modifier mon avatar' name='submit' style="margin-left:0px;"></p>
</div>
</form>
</div>

</div>

</body></html>