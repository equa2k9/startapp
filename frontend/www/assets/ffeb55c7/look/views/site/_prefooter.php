<!--PREFOOTER-->
    <div class="prefooter">
        <div class="container">
            <div class="row">
                <div class="col-xs-8">
                    <h4><?php echo Yii::t('site','About store')?></h4>
                    <p><?php echo Yii::app()->settings->get('admin','astore_'.Yii::app()->language)?>
                    </p>
                </div>
                <div class="col-xs-4">
                    <h4><?php echo Yii::t('site','Contacts')?></h4>
                    <ul class="prefooter_contacts">
                        <li><?php echo Yii::app()->settings->get('admin', 'adress_'.Yii::app()->language)?></li>
                        <li><?php echo Yii::app()->settings->get('admin', 'phone1_')?></li>
                        <li><?php echo Yii::app()->settings->get('admin', 'phone2_')?></li>
                        <li class="email_contact"><?php echo Yii::app()->settings->get('admin','email1')?></li>
                         <li class="email_contact"><?php echo Yii::app()->settings->get('admin','email2')?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--PREFOOTER-->