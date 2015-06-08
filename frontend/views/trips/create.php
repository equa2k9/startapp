<?php

Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places');
?>
<script>
var directionsDisplay = {};
var directionsService = new google.maps.DirectionsService();
var map = {};

function initialize(key) {
    directionsDisplay[key] = new google.maps.DirectionsRenderer();
    var denver = new google.maps.LatLng(39.735831, -104.998620);
    var mapOptions = {
        zoom: 10,
        center: denver
    }
    var input = document.getElementById('TripsPassengers_'+key+'_pickup_adress');
    var input2 = document.getElementById('TripsPassengers_'+key+'_dropoff_adress');
    var options = {componentRestrictions: {country: 'us'}};

    new google.maps.places.Autocomplete(input, options);
    new google.maps.places.Autocomplete(input2, options);
    map[key] = new google.maps.Map(document.getElementById('map-canvas-'+key), mapOptions);
    directionsDisplay[key].setMap(map[key]);
    calcRoute(1,key);
}

function calcRoute(type,key) {
    var start = document.getElementById('TripsPassengers_'+key+'_pickup_adress').value;
    var end = document.getElementById('TripsPassengers_'+key+'_dropoff_adress').value;
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.IMPERIAL
    };
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {

            if (type !== undefined)
            {
                var mileage = document.getElementById('TripsPassengers_'+key+'_mileage');
                var duration = document.getElementById('TripsPassengers_'+key+'_google_time');
                var durationsec = document.getElementById('TripsPassengers_'+key+'_google_sec');
                duration.value = (response.routes[0].legs[0].duration.text);
                durationsec.value = (response.routes[0].legs[0].duration.value);
//                changeDropoff(response.routes[0].legs[0].duration.value);
                mileage.value = (response.routes[0].legs[0].distance.value * 0.00062137).toFixed(3);

            }
            directionsDisplay[key].setDirections(response);


        }
    });
    setTimeout(map[key].setZoom(13),4000);
}
</script>

<?php
$form = $this->beginWidget('DynamicTabularForm', array(
    'defaultRowView' => '//trips/_tripsPassengers',
        ));
?>

<?php echo $form->rowForm($tripsPassengers); ?>
<hr>
<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $trips->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>
<?php $this->endWidget();?>
