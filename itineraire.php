<?php
	session_start();
	include("boutonDeco.php");
?>
<!DOCTYPE html> 
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Calcul d'itinéraire</title>
	 <link rel="stylesheet" href="design.css" type="text/css" /> 
    <link rel="stylesheet" href="calcul-itineraire\jquery-ui-1.8.12.custom.css" type="text/css" /> 
  </head>
  <style type="text/css">
    #container h1{border-bottom:1px solid #ccc;
	font-size:14px;
	font-weight:bold;
	letter-spacing:2px;
	margin-bottom:10px;
	margin-left:30px;
	text-transform:uppercase;}
	
  </style>
  <body>
	<?php include("logo.php"); ?>
	<?php include("menu.php"); ?>
    <div id="container">
        <h1>Calcul d'itinéraire</h1>
        <div id="destinationForm">
            <form action="" method="get" name="direction" id="direction">
                <label>Point de départ :</label>
                <input type="text" name="origin" id="origin">
                <label>Destination :</label>
                <input type="text" name="destination" id="destination">
			
                <input type="button" value="Calculer l'itinéraire" onclick="javascript:calculate()">
				
            </form>
        </div>
        <div id="panel"></div>
        <div id="map">
            <p>Veuillez patienter pendant le chargement de la carte...</p>
        </div>
    </div>
    
    <!-- Include Javascript -->
    <script type="text/javascript" src="calcul-itineraire\jquery.min.js"></script>
    <script type="text/javascript" src="calcul-itineraire\jquery-ui-1.8.12.custom.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=fr"></script>
    <script type="text/javascript" src="calcul-itineraire\functions.js"></script>
  </body>
</html>
