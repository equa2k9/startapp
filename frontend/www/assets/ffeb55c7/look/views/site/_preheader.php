<!--PREHEADER-->
    <div class="preheader">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 columns">
                    <p class="welcome_phrase"><?php echo Yii::t('site','Welcome to our store')?></p>
                </div>
                <div class="col-xs-6 columns">
                    <p class="contact_info">
                        <span><?php echo Yii::app()->settings->get('admin', 'phone1')?></span>
                        <span><?php echo Yii::app()->settings->get('admin', 'phone2')?></span>
                        <span><?php echo Yii::app()->settings->get('admin', 'adress_'.Yii::app()->language)?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--PREHEADER-->