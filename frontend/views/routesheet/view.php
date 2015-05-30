
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
    var map, directionsService;

    function renderDirections(result, polylineOpts) {
        var directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        if (polylineOpts) {
            directionsRenderer.setOptions({
                polylineOptions: polylineOpts
            });
        }

        directionsRenderer.setDirections(result);
    }

    function requestDirections(start, end, polylineOpts) {
        directionsService.route({
            origin: start,
            destination: end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        }, function (result) {
            renderDirections(result, polylineOpts);
        });
    }

    function initialize() {

        var mapOptions = {
            zoom: 4,
            center: new google.maps.LatLng(39.5, -98.35),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsService = new google.maps.DirectionsService();
<?php

$count = 0;

foreach (Trips::getAddresses($model->id) as $value):?>


        requestDirections(<?php echo "'$value[0]'" ?>, <?php echo "'$value[1]'" ?>, {strokeColor:<?php echo "'" . CommonHelper::$colors[rand(0, 23)] . "'" ?>});
        <?php
                    if ($count == 9)
                        {break;}
                    $count++;
                ?>
<?php endforeach;?>


        setTimeout(function () {
            map.setZoom(10);
        }, 1000);



    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>

<div class="page-header">
    <h2>
        Route Sheet №<?php echo $model->id ?><small></small>
    </h2>
</div>
<div id="map-canvas" class="img-responsive" style="height: 450px;"></div>
<hr>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'trips-grid',

    'dataProvider' => $trips->search(),
    'filter'=>$trips,
    'ajaxUpdate' => true,
    'responsiveTable' => true,
    'htmlOptions' => array('style' => 'padding-top: 0!important;'),
    'template' => "{items}",
    'columns' => array(
        array(
            'name' => 'id',
            'value' => '$data->id',
            'headerHtmlOptions' => array('class' => 'id-col', 'style' => 'width: 3%')
        ),
        array(
            'type'=>'raw',
            'header' => 'Client Name',
            'filter'=>CHtml::activeTextField($trips,'searchClient',array('class'=>'form-control')),
            'value' => function($data,$string)
            {

                $string = '';
                foreach($data->tripsPassengers as $value)
                {

                    $string.=$value->passengers->clients->name.'<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('class' => 'id-col', 'style' => 'width: 10%')
        ),
        array(
            'type'=>'raw',
            'filter'=>CHtml::activeTextField($trips,'searchPassenger',array('class'=>'form-control')),
            'name' => 'searchPassenger',
            'value' => function($data,$string)
            {
                $string = '';
                foreach($data->tripsPassengers as $value)
                {
                    $string.=$value->passengers->name.'<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('style' => 'width: 10%')
        ),
        array(
            'type' => 'raw',
            'name' => 'tripsPassengers.pickup_time',
            'value' =>function($data, $string) {
                $string = '';
                foreach ($data->tripsPassengers as $value)
                {
                    $string .= date("m/d/Y", $value->pickup_time) . '<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('style' => 'width: 10%')
        ),
        array(
            'type'=>'raw',
            'name' => 'tripsPassengers.pickup_time',
            'value' => function($data, $string) {
                $string = '';
                foreach ($data->tripsPassengers as $value)
                {
                    $string .= date("h:i A", $value->pickup_time) . '<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('style' => 'width: 10%')
        ),
        array(
            'type'=>'raw',
            'name' => 'tripsPassengers.pickup_adress',
            'filter'=>CHtml::activeTextField($trips,'searchPickup',array('class'=>'form-control')),
            'value' => function($data, $string) {
                $string = '';
                foreach ($data->tripsPassengers as $value)
                {
                    $string .= $value->pickup_adress . '<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('style' => 'width: 20%')
        ),
        array(
            'type'=>'raw',
            'filter'=>CHtml::activeTextField($trips,'searchDropoff',array('class'=>'form-control')),
            'name' => 'tripsPassengers.dropoff_adress',
            'value' => function($data, $string) {
                $string = '';
                foreach ($data->tripsPassengers as $value)
                {
                    $string .= $value->dropoff_adress . '<br>';
                }
                return $string;
            },
            'headerHtmlOptions' => array('style' => 'width: 20%')
        ),
        array(
            'type'=>'raw',
            'filter'=>CHtml::activeTextField($trips,'searchContractor',array('class'=>'form-control')),
            'name' => 'tripsInfo.contractor_id',
            'value' => '$data->tripsInfo->contractor_id',
            'headerHtmlOptions' => array( 'style' => 'width: 8%')
        ),
        array(
            'type'=>'raw',
            'filter'=>CHtml::activeTextField($trips,'searchInitialfee',array('class'=>'form-control')),
            'name' => 'tripsPassengers.tripsPays.initial_fee',
            'value' => function($data) {
                $string='';
                foreach ($data->tripsPassengers as $value)
                {
                    foreach($value->tripsPays as $pays)
                    {
                        $string.=$pays->initial_fee.'<br>';
                    }
                }
                return $string;
            },
            'visible' => Yii::app()->user->role != 'driver',
            'headerHtmlOptions' => array( 'style' => 'width: 14%')
        ),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'headerHtmlOptions' => array( 'style' => 'width: 5%'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("trips/view/$data->id")',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("trips/update", array("trip_id"=>"$data->id"))',
                    'visible' => 'Yii::app()->user->checkAccess("admin")||Yii::app()->user->checkAccess("dispatcher")',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("trips/delete/$data->id")',
                    'visible' => 'Yii::app()->user->checkAccess("admin")||Yii::app()->user->checkAccess("dispatcher")',
                ),
            ),
        ),

    ),
));