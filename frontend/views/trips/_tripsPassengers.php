<?php
$row_id = "tripsPassengers-" . $key ?>
<div class='row-fluid' id="<?php echo $row_id ?>" >
    <?php
    echo $form->hiddenField($model, "[$key]id");
    echo $form->updateTypeField($model, $key, "updateType", array('key' => $key));
    ?>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-2">
<!--                --><?php //echo $form->textFieldGroup($model, "[$key]passengers_id", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5','placeholder'=>false)))); ?>
                <?php echo $form->dropDownListGroup(
                    $model,
                    "[$key]clients_id",
                    array(
                        'wrapperHtmlOptions'=>array(

                        ),
                        'widgetOptions' => array(

                            'data' => Clients::getAllClients(),
                            'htmlOptions' => array(

                                'value'=>"[$key]$model->clients_id",
                                'empty'=>'Choose client',
                                'multiple' => false,
                                'ajax' => array(
                                    'type'=>'POST', //request type
                                    'url'=>$this->createUrl('getPassengers'), //url to call.

                                    //selector to update
                                    'data'=>array('clients_id'=>'js:this.value'),
                                    'update'=>'#'.CHtml::activeId($model,"[$key]passengers_id"),

                                ),
                ),
                        )
                    )
                ); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->dropDownListGroup($model, "[$key]passengers_id", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5','placeholder'=>false, 'value'=>'')))); ?>
            </div>

            <div class="col-md-2">
                <?php
                // echo $form->textFieldGroup($model->driversInfo,'worked_from',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5'))));
                echo $form->labelEx($model, "[$key]pickup_time");
                $this->widget(
                    'common.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                        'model' => $model,
                        'attribute' => "[$key]pickup_time",
                        'mode'=>'datetime', // available parameter is datetime or time
                        'language'=>'en-GB',
                        'options'=>array(
                            'ampm'=>true,
                            "dateFormat"=>'mm/dd/yy',
                            'timeFormat'=>'hh:mm tt'
//                            'language'=>'en-GB',
//                            'regional'=>'en-GB',
                        ),

                        'htmlOptions' => array('class'=>'form-control'),
                    )
                );
                ?>
                <?php echo $form->error($model,"[$key]pickup_time")?>
            </div>
            <div class="col-md-2">
                <?php
                // echo $form->textFieldGroup($model->driversInfo,'worked_from',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5'))));
                echo $form->labelEx($model, "[$key]dropoff_time");
                $this->widget(
                    'common.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                        'model' => $model,
                        'attribute' => "[$key]dropoff_time",
                        'mode'=>'datetime', // available parameter is datetime or time
                        'language'=>'en-GB',
                        'options'=>array(
                            "dateFormat"=>'mm/dd/yy',

//                            'language'=>'en-GB',
//                            'regional'=>'en-GB',
                        ),

        'htmlOptions' => array('class'=>'form-control','disabled'=>true),
                    )
                );
                ?>
                <?php echo $form->error($model,"[$key]dropoff_time")?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]dropoff_zipcode", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5','placeholder'=>false)))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]pickup_zipcode", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5','placeholder'=>false)))); ?>
            </div>

        </div>
        <div class="row">




            <div class="col-md-8">
                <?php echo $form->textFieldGroup($model, "[$key]pickup_adress", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255,
                    'onclick'=>"calcRoute(1, $key)", 'onafterprint'=>"calcRoute(1, $key)", 'onfocusout'=>"calcRoute(1, $key)",'placeholder'=>false
                )))); ?>
            </div>

            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]google_time", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100,'placeholder'=>false,'disabled'=>true)))); ?>
            </div>
            <div class="col-md-2">
                <?php echo $form->textFieldGroup($model, "[$key]mileage", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100,'placeholder'=>false,'disabled'=>true)))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php echo $form->textFieldGroup($model, "[$key]dropoff_adress", array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255,
                    'onclick'=>"calcRoute(1, $key)", 'onafterprint'=>"calcRoute(1, $key)", 'onfocusout'=>"calcRoute(1, $key)",'placeholder'=>false
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
    <?php echo $form->deleteRowButton($row_id, $key); ?>
</div>
<script>

    $(document).ready(function () {
        initialize(<?php echo $key?>);
        getPassengers(<?php echo $key?>,<?php echo $model->passengers_id!=null?$model->passengers_id:0?>);
    });
    </script>

