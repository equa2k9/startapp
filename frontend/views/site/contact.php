<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('site', 'Contact us');
$this->breadcrumbs = array(Yii::t('site', 'Contact us'));
?>
<div class="col-md-12 well">
    <div class="col-md-9 ">
        <div class="map_container" id="gmap_canvas"></div>

        <h3><?php echo Yii::t('site', 'If you have some questions, please contact us.') ?></h3><br>

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'contact-form',
            'type' => 'vertical',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textFieldGroup($model, 'name'); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->textFieldGroup($model, 'subject'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textFieldGroup($model, 'email'); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->textFieldGroup($model, 'phone'); ?>
            </div>
        </div>
        <?php echo $form->textAreaGroup($model, 'body', array('rows' => 15)); ?>



        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'label' => Yii::t('site', 'Send'),
        ));
        ?>

        <?php $this->endWidget(); ?>
    </div>

    <div class="col-md-3">
        <div class="headline"><h2><?php echo Yii::t('site', 'Sergiy') ?></h2></div>
        <hr>
        <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-envelope"></i><?php echo Yii::app()->settings->get('admin', 'email2') ?></a></li>
            <li><a href="#"><i class="fa fa-phone"></i><?php echo Yii::app()->settings->get('admin', 'phone2') ?></a></li>
        </ul>

        <div class="headline"><h2><?php echo Yii::t('site', 'Volodymyr') ?></h2></div>
        <hr>
        <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-envelope"></i><?php echo Yii::app()->settings->get('admin', 'email1') ?></a></li>
            <li><a href="#"><i class="fa fa-phone"></i><?php echo Yii::app()->settings->get('admin', 'phone1') ?></a></li>
        </ul>

        <div class="headline"><h2><?php echo Yii::t('site', 'Our office placed') ?></h2></div>
        <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-home"></i><?php echo Yii::t('site', 'Oleny Stepanivny St 45, Lviv, Ukraine') ?></a></li>
        </ul>


    </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    function init_map() {
        var myOptions = {
            zoom: 18,
            center: new google.maps.LatLng(49.842273, 24.002056),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
        marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(49.842273, 24.002056)
        });
        infowindow = new google.maps.InfoWindow({content: "<b></b><br/><br/> "});
        google.maps.event.addListener(marker, "click", function () {
            infowindow.open(map, marker);
        });
    }
    google.maps.event.addDomListener(window, 'load', init_map);
</script>