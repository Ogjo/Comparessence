<?php
	if(empty($_SESSION['pseudo']))
	{ ?>
		<a href="inscription.php" class="boutonDeco" style="margin-top: 18px;">S'inscrire</a>
	<?php }
	
	if(isset($_SESSION['pseudo']))
	{
		echo '<div style="float: right; margin-top: 18px; margin-right: 10px;">Bienvenue '.$_SESSION["pseudo"].'</div>';
		echo '<a href="deconnexion.php" class="boutonDeco" style="margin-top: 46px;">Déconnexion</a>';
	}
	elseif(empty($_SESSION['pseudo']))
	{ ?>
		<a href="connexion.php" class="boutonDeco" style="margin-top: 46px;">Se connecter</a>
	<?php }
?>