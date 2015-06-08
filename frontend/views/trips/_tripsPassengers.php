
<?php //var_dump($model->attributes);exit;
$row_id = "tripsPassengers-" . $key ?>
<div class='row-fluid' id="<?php echo $row_id ?>" >
    <?php
    echo $form->hiddenField($model, "[$key]id");
    echo $form->updateTypeField($model, $key, "updateType", array('key' => $key));
    ?>
    <div class="col-md-8">
        <div class="row">

            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]passengers_id", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]passengers_id", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]pickup_time", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]dropoff_time", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]dropoff_zipcode", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]pickup_zipcode", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
            </div>

        </div>
        <div class="row">




            <div class="col-md-8">
                <?php echo $form->textFieldGroup($model, "[$key]pickup_adress", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255,
                    'onclick'=>"calcRoute(1, $key)", 'onafterprint'=>"calcRoute(1, $key)", 'onfocusout'=>"calcRoute(1, $key)"
                )))); ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]google_time", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]mileage", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php echo $form->textFieldGroup($model, "[$key]dropoff_adress", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255,
                    'onclick'=>"calcRoute(1, $key)", 'onafterprint'=>"calcRoute(1, $key)", 'onfocusout'=>"calcRoute(1, $key)"
                )))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->hiddenField($model, "[$key]google_sec"); ?>
            </div>
            </div>

    </div>

    <div class="col-md-4">
        <div class="row">
            <div id="map-canvas-<?php echo $key?>" style="height: 300px"></div>
        </div>
    </div>
    <div class="row">
    <div class="pull-right"><?php echo $form->deleteRowButton($row_id, $key); ?></div>
        </div>
    <hr>
</div>
<script>
    $(document).ready(function () {
        initialize(<?php echo $key?>);
    });
    </script>


