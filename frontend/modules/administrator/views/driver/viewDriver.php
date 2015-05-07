<?php
$not_activated = ($model->is_activated == Users::IS_NOT_ACTIVATED);
$this->renderPartial('/driver/_setRates', array('modelDriver' => $model, 'model' => new DriversRate()), FALSE);
?>

<div class="page-header">
    <h2>
        View Driver <?php echo ($not_activated) ? 'Form <small> №' . $model->id : $model->id ?></small>
        <?php
        if ($not_activated)
        {
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'label' => 'Enroll this driver',
                'context' => 'warning',
                'url' => Yii::app()->createUrl('administrator/dashboard/enrollDriver', array('id' => $model->id)),
                'buttonType' => 'link',
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
                    )
            );
        }
        ?>  
    </h2>
</div>
<div class="row">
    <?php $this->renderPartial('/driver/_info',array('model'=>$model,'not_activated'=>$not_activated))?>
    <?php $this->renderPartial('/driver/_rates',array('model'=>$model,'not_activated'=>$not_activated,'rates'=>$rates))?>
    <?php $this->renderPartial('/driver/_files',array('model'=>$model->driversFiles))?>
</div>