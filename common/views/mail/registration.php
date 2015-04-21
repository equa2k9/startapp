<?php
           echo isset($model->hash_link)?Yii::app()->createAbsoluteUrl('site/confirm', array('link' => $model->hash_link)) :'Something went wrong, please contact with administrator';
            ?>
<br>
