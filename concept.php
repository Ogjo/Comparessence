<?php
	session_start();
	include("boutonDeco.php");
?>
<!DOCTYPE html>
<html lang="fr"><head>
<link rel="stylesheet" type="text/css" href="design.css">
<title>Comparessence</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head><body>

<?php include("logo.php"); ?>
<?php include("menu.php"); ?>

<br/>

<h1 align="center" color= "bleu"><blink>Nos conseils</blink></h1>

<p>Voici quelques conseils bien pratiques pour faire des économies sur le carburant !</p>

<ul>
   <li type="I" >Avant de partir</li>
      <ol>
         <li type="disc"> Choix et usage du véhicule</li>
            <ul>
               <li type="circle">Optez pour le modèle qui répond le mieux à vos besoins tout en consommant et polluant le moins.</li>
               <li type="circle">En ville notamment, pensez aussi au covoiturage, aux transports en commun, au vélo, ou à la marche !</li>
            </ul>	 
         <li type="disc">Etat du véhicule</li>
			<ul>
               <li type="circle">Un filtre à air encrassé peut augmenter jusqu’à 3 % la consommation de carburant.</li>
               <li type="circle">Des pneus correctement gonflés réduisent la résistance au roulement, et donc la consommation, tout en améliorant la sécurité.</li>
            </ul>
			
		<li type="disc">Chargement</li>
			<ul>
               <li type="circle">Plus votre voiture est chargée, plus elle consomme ! Avant de partir, retirez les objets inutiles du coffre ou de l’habitacle.</li>
               <li type="circle">Démontez le porte-bagages ou le coffre de toit non-utilisés. Tout objet augmentant la résistance à l’air du véhicule est facteur de surconsommation.</li>
            </ul>
			
      </ol>	 
	  
	  
   <li  type="I">En route</li>
   
   <li type="disc">Démarrage et arrêt</li>
			<ul>
               <li type="circle">Allumez le moteur sans actionner la pédale d’accélérateur, et partez sans attendre qu’il soit chaud.</li>
               <li type="circle">En cas d’arrêt dépassant les 20 secondes, il est plus économe de couper le moteur et de le redémarrer.</li>
            </ul>
			
	<li type="disc">Conduite</li>
			<ul>
               <li type="circle">Conduisez avec calme et anticipation, en évitant les accélérations et les freinages fréquents.</li>
               <li type="circle">Plutôt que la pédale de frein, privilégiez le frein moteur.</li>
            </ul>
			
	<li type="disc">Passages de vitesse</li>
			<ul>
               <li type="circle">Changez de rapports le plus vite possible (avant 2 000 Tr/min en diesel et 2 500 Tr/min en essence).</li>
               <li type="circle">Roulez de préférence à bas régime et n’hésitez pas à engager la 5e, même en circulation urbaine.
</li>
            </ul>
			
	<li type="disc">Gestion de la vitesse</li>
			<ul>
               <li type="circle">Respecter les limitations de vitesses permet de réduire le risque d’accident, d’économiser du carburant ainsi que de réduire vos émissions de CO2, en particulier sur autoroute</li>
               
            </ul>
			
	<li type="disc">Résistane  l'air</li>
			<ul>
               <li type="circle">Evitez d’ouvrir les vitres latérales ou le toit inutilement quand vous roulez à une allure soutenue. Cela peut provoquer une surconsommation de 5 %.</li>
            </ul>
     
		
	
	  
</ul>

<h1 align="center" color= "bleu">Mieux comprendre le prix des carburants</h1>

<div class="left" style="width: 63%; text-align: justify;">
Le prix des carburants est déterminé par divers éléments décrits dans le tableau ci-contre.<br/>
Les prix varient en fonction du prix du pétrole, libellé en dollar, du taux de change avec le dollar, et des taxes.<br/><br/>
Les taxes sont composées de:<br/>
<div class="tab"></div>- La TICPE (Taxe Intérieure de Consommation sur les Produits Energétiques): elle remplace l'ancienne TIPP (Taxe Intérieure de consommation sur les Produits Pétroliers). C'est un montant fixe perçu sur les 
volumes vendus. Le Sans Plomb est taxé de plus de 17 cts par rapport au gazole. Les régions peuvent appliquer une majoration de la TICPE de 0,025€ par litre, seules trois se sont abstenues de le faire. Cette taxe 
représente 4,5% des recettes de l'Etat, soit 24 milliards d'euros en 2010 (14 milliards pour l'Etat, 10 pour les collectivités locales).<br/>
<div class="tab"></div>- La TVA: elle s'applique à un taux de 19,6%. Contrairement à la TICPE, montant fixe sur le volume, la TVA augmente au fur et à mesure que le prix du pétrole grimpe.<br/><br/>

</div>
<div style="padding-left: 700px;">
<?php $brent=120.08; $eurusd=1.3108; $brenteur=$brent/$eurusd; $litre=$brenteur/158.9873; $tipcego=0.4419; $tipcesp=0.6142; $raff=0.025; $distr=0.1;
$sstgo=$litre+$tipcego+$raff+$distr; $sstsp=$litre+$tipcesp+$raff+$distr; $tvago=$sstgo*0.196; $tvasp=$sstsp*0.196; $totgo=$sstgo+$tvago; $totsp=$sstsp+$tvasp;
$taxgo=(($tipcego+$tvago)/$totgo)*100; $taxsp=(($tipcesp+$tvasp)/$totsp)*100;
?>
<table border="1" cellpadding="2px" style="border-collapse: collapse; font-size: 1.0em;">
	<tr><th>Le 11/04/2012</th><th>Gazole</th><th>Sans Plomb</th></tr>
	<tr><td>Cotation Pétrole Brent</td><td colspan=2 align="center"><?php echo $brent."$";?></td></tr>
	<tr><td>Cotation €/$</td><td colspan=2 align="center"><?php echo $eurusd;?></td></tr>
	<tr><td>Cotation Pétrole Brent</td><td colspan=2 align="center"><?php echo round($brenteur, 4)."€";?></td></tr>
	<tr><td>Prix brut (1 baril = 159 L)</td><td colspan=2 align="center"><?php echo round($litre, 4)."€";?></td></tr>
	<tr><td>+ TIPCE</td><td align="center"><?php echo $tipcego."€";?></td><td align="center"><?php echo $tipcesp."€";?></td></tr>
	<tr><td>+ Raffinage</td><td colspan=2 align="center"><?php echo $raff."€";?></td></tr>
	<tr><td>+ Distribution transport</td><td colspan=2 align="center"><?php echo $distr."€";?></td></tr>
	<tr><td>Sous-total</td><td align="center"><?php echo round($sstgo, 4)."€";?></td><td align="center"><?php echo round($sstsp, 4)."€";?></td></tr>
	<tr><td>+ TVA</td><td align="center"><?php echo round($tvago, 4)."€";?></td><td align="center"><?php echo round($tvasp, 4)."€";?></td></tr>
	<tr style="font-weight: bold;"><td>Total (hors marges)</td><td align="center"><?php echo round($totgo, 4)."€";?></td><td align="center"><?php echo round($totsp, 4)."€";?></td></tr>
	<tr><td>Taxes</td><td align="center"><?php echo round($taxgo, 1)."%";?></td><td align="center"><?php echo round($taxsp, 1)."%";?></td></tr>
</table></div>


</body></html>