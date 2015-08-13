<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('site', 'Contact us');
$this->breadcrumbs = array(Yii::t('site', 'Contact us'));
?>
<div class="contacts">
    <div class="container">
        <h3 class="catalog_heading"><?php echo Yii::t('site', 'If you have some questions, please contact us.') ?></h3>
        <div class="map_wrapper">
            <div id="gmap_canvas" style="width: 100%; height: 100%"></div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="contact_us">
                    <h4><?php echo Yii::t('site','Contact with us')?></h4>
                    <p>
                        <?php echo Yii::t('site','Спасибі, що відвідали наш сайт.
                        Будь ласка, заповніть наступну форму,
                        щоб дізнатись більш детальну інформацію про наші продукти,
                        або для отримання зворотного зв\'язку.')?>
                        
                    </p>
                </div>

                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'contact-form',
                    'type' => 'vertical',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'contact_us_form'),
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>
                <div class="row">
                    <div class="col-xs-9">

                        <?php echo $form->textFieldGroup($model, 'name', array('widgetOptions' => array('htmlOptions' => array('class' => 'base_input')))); ?>
                        <?php echo $form->textFieldGroup($model, 'subject', array('widgetOptions' => array('htmlOptions' => array('class' => 'base_input')))); ?>
                        <?php echo $form->textFieldGroup($model, 'email', array('widgetOptions' => array('htmlOptions' => array('class' => 'base_input')))); ?>
                        <?php echo $form->textFieldGroup($model, 'phone', array('widgetOptions' => array('htmlOptions' => array('class' => 'base_input')))); ?>


                        <?php echo $form->textAreaGroup($model, 'body', array('rows' => 15, 'widgetOptions' => array('htmlOptions' => array('class' => 'base_input')))); ?>


                        <div class="form-group">
                            <?php
                            $this->widget('bootstrap.widgets.TbButton', array(
                                'buttonType' => 'submit',
                                'label' => Yii::t('site', 'Send'),
                                'htmlOptions' => array('class' => 'base_btn')
                            ));
                            ?>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="other_info">
                    <h4><?php echo Yii::t('site', 'Contact information') ?></h4>
                    <div class="headline"><?php echo Yii::t('site', 'Sergiy') ?></div>

                    <ul>
                        <li><span class="fa fa-envelope"></span><?php echo Yii::app()->settings->get('admin', 'email2') ?></li>
                        <li><span class="fa fa-phone"></span><?php echo Yii::app()->settings->get('admin', 'phone2') ?></li>
                    </ul>

                    <div class="headline"><?php echo Yii::t('site', 'Volodymyr') ?></div>

                    <ul>
                        <li><span class="fa fa-envelope"></span><?php echo Yii::app()->settings->get('admin', 'email1') ?></li>
                        <li><span class="fa fa-phone"></span><?php echo Yii::app()->settings->get('admin', 'phone1') ?></li>
                    </ul>

                    <h4><?php echo Yii::t('site', 'Adress') ?></h4>
                    <ul>
                        <li><span class="fa fa-home"></span><?php echo Yii::app()->settings->get('admin', 'adress_' . Yii::app()->language) ?></li>
                    </ul>
                    <h4><?php echo Yii::t('site', 'Working hours') ?></h4>
                </div>

            </div>
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