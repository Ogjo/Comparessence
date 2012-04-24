
<link rel="stylesheet" type="text/css" href="design.css">
<div id="menu"><div align="center">
<a href="index.php" class="bouton" style="width: 130px;">Accueil</a><div class="tab"></div>
<a href="renseignerPrix.php" class="bouton">Renseigner un prix</a><div class="tab"></div>
<a href="addStation.php" class="bouton">Ajouter une station</a><div class="tab"></div>
<a href="itineraire.php" class="bouton" style="width: 130px;">Itinéraire</a><div class="tab"></div>

<?php
	if(isset($_SESSION['pseudo'])) { ?>
		<a href="monCompte.php" class="bouton" style="width: 130px;">Mon compte</a><div class="tab"></div>
<?php	} ?>
	<a href="concept.php" class="bouton" style="width: 100px;">Concept</a>

<br/></div></div>