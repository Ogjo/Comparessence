var map;
var panel;
var initialize;
var calculate;
var direction;

initialize = function(){
  var latLng = new google.maps.LatLng(48.81421156698257 ,  2.377338409423828); // Correspond au coordonnées de l'emplacement de la map au départ ici Ivry-sur-Seine In'tech Info
  var myOptions = {
    zoom      : 14, // Zoom par défaut
    center    : latLng, // Coordonnées de départ de la carte de type latLng 
    mapTypeId : google.maps.MapTypeId.ROADMAP, // Type de carte, différentes valeurs possible HYBRID(satéllite), ROADMAP(rue jaune/blanche gris), SATELLITE(sans légendes), TERRAIN(gris)
    maxZoom   : 20
  };
  
  map      = new google.maps.Map(document.getElementById('map'), myOptions);
  panel    = document.getElementById('panel');
  
  var marker = new google.maps.Marker({
    position : latLng,
    map      : map,
    title    : "In'Tech INFO"
    //icon     : "marker_lille.gif" // Chemin de l'image du marqueur pour surcharger celui par défaut
  });
  
  var contentMarker = [
      '<div id="containerTabs">',
      '<div id="tabs">',
      '<ul>',
        '<li><a href="#tab-1"><span>Thomas</span></a></li>',
        '<li><a href="#tab-2"><span>Stephane</span></a></li>',
        '<li><a href="#tab-3"><span>Joris</span></a></li>',
      '</ul>',
      '<div id="tab-1">',
        '<h3>Kikou Bankster</h3><p>SONY VAIO azea srthdrhjdryh jsngshrhter sdfghhseoth odmfhghoerh erhgmoh.</p>',
      '</div>',
      '<div id="tab-2">',
       '<h3>TITI</h3><p>HP de lécole pjpdjpgsdjgsdfg spdjgpsdgjsdfgj sdfgjsdogjsdfgj.</p>',
      '</div>',
      '<div id="tab-3">',						
		'<h3>Jojo</h3><ul><li>essence</li><li>gazole</li><li>SP95</li><li>sans plomb</li></ul>',
      '</div>',
      '</div>',
      '</div>',
      '</div>'
  ].join('');

  var infoWindow = new google.maps.InfoWindow({
    content  : contentMarker,
    position : latLng
  });
  
  google.maps.event.addListener(marker, 'click', function() {
    infoWindow.open(map,marker);
  });
  
  google.maps.event.addListener(infoWindow, 'domready', function(){ // infoWindow est biensûr notre info-bulle
    jQuery("#tabs").tabs();
  });
  
  
  direction = new google.maps.DirectionsRenderer({
    map   : map,
    panel : panel // Dom element pour afficher les instructions d'itinéraire
  });

};

calculate = function(){
    origin      = document.getElementById('origin').value; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            }
        });
    }
};

initialize();
