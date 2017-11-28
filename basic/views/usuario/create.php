<!DOCTYPE html>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = Yii::t('app', 'Create Usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>









<!----div do mapa--->
<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
var mapa, marcador, geocoder, infoWindow;
//funcao que carrega o mapa e inicializa os pontos (places) com os endereços. 
//OBS - marcador apenas para recuperar a latitude e longitude - NECESSARIO A Key do GMaps 

function myMap() {
	//carrega o mapa
  geocoder = new google.maps.Geocoder();

	//carrega o mapa na div, em ponto especifico - Manaus - AM
    mapa = new google.maps.Map(document.getElementById('googleMap'), {
        center: {lat: -3.1, lng: -60},
        zoom: 16
    });

	
	//carregar as informacoes dos lugares (places) do mapa
	    infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localização não encontrada.');
            infoWindow.open(map);
            mapa.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, mapa.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, mapa.getCenter());
        }

	//cria o marcado para mostrar
    marcador = new google.maps.Marker({
        map: mapa,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: -3.1, lng: -60}
    });

	//recupera os dados do marcador e adiciona os valores no campo do formulario
    marcador.addListener('click', toggleBounce);
	marcador.addListener('position_changed', function(){
		
		document.getElementById('usuario-latitude').value = marcador.getPosition().lat();
		document.getElementById('usuario-longitude').value = marcador.getPosition().lng();
	});

	//adicionar uma search para o mapa quando clicar em outros pontos
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    mapa.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    mapa.addListener('bounds_changed', function() {

        searchBox.setBounds(mapa.getBounds());
    });

    searchBox.addListener('places_changed', function() {

        var places = searchBox.getPlaces();

        if (places.length === 0) return;

        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {

            if (!place.geometry) return;

            marcador.setPosition(place.geometry.location);

            if (place.geometry.viewport) bounds.union(place.geometry.viewport);
            else bounds.extend(place.geometry.location);
        });

        mapa.fitBounds(bounds);
    });
	
	
	//========
	    infoWindow = new google.maps.InfoWindow;
		infoWindow.open(mapa);

 // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localizacao nao encontrada.');
            infoWindow.open(map);
            map.setCenter(pos);
		})};
	//======
}


function geocodeAddress(address) {

    geocoder.geocode({'address': address}, function(results, status) {

        if (status === 'OK') {

            mapa.setCenter(results[0].geometry.location);
            mapa.setZoom(16);
            marcador.setPosition(results[0].geometry.location);
        }
    });
}

function toggleBounce() {

    if(marcador.getAnimation() !== null) marcador.setAnimation(null);
    else marcador.setAnimation(google.maps.Animation.BOUNCE);
}





</script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbmnAvnVUjgvnBE5vhHwmJR3y8RcN5v_4&callback=myMap"async defer></script>
