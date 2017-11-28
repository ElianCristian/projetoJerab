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

	<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
var mapa, marcador, geocoder;

function myMap() {


  geocoder = new google.maps.Geocoder();

    mapa = new google.maps.Map(document.getElementById('googleMap'), {
        center: {lat: -3.1, lng: -60},
        zoom: 16
    });


//var map=new google.maps.Map(document.getElementById("googleMap"),mapa);

    marcador = new google.maps.Marker({
        map: mapa,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {lat: -3.1, lng: -60}
    });

    marcador.addListener('click', toggleBounce);

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


google.maps.event.trigger(point, "click");

for (var i = 0; i < 5; i++) {
    var pointString = '<li><a href="#" class="openPoint" id="point' + i + '" pointID="' + i + '">' + myPoints[i][0] + ' - ' + myPoints[i][1] + ' Miles Away</a></li>';
    $('#pointsGoHere').append(pointString);
}
$('.openPoint').each(function () {
    $(this).click(function (e) {
        e.preventDefault();
        var pointID = parseInt($(this).attr('pointID'));
        google.maps.event.trigger(myPoints[pointID][4], "click");
    });
});
</script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbmnAvnVUjgvnBE5vhHwmJR3y8RcN5v_4&callback=myMap"async defer></script>
