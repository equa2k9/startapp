<?php
$not_activated = ($model->is_activated == Users::IS_NOT_ACTIVATED);
$this->renderPartial('_setRates', array('modelDriver' => $model, 'model' => new DriversRate()), FALSE);
$this->renderPartial('_driversComments', array('model'=>$model), FALSE);
?>

<div class="page-header">
    <h2>
        View Driver <?php echo ($not_activated) ? 'Form <small> №' . $model->id : $model->id ?></small>
        <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Comments',
                'context' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#drivers-comments',
                ),
            )
        );
        if ($not_activated)
        {
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'label' => 'Enroll this driver',
                'context' => 'warning',
                'url' => Yii::app()->createUrl('administrator/drivers/enroll', array('id' => $model->id)),
                'buttonType' => 'link',
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
                    )
            );
        }
        else
        {
            $this->widget(
                'bootstrap.widgets.TbButton', array(
                    'label' => 'Deactivate driver',
                    'context' => 'danger',
                    'url' => Yii::app()->createUrl('administrator/drivers/deactivate', array('id' => $model->id)),
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
    <?php $this->renderPartial('_info',array('model'=>$model,'not_activated'=>$not_activated))?>
    <?php $this->renderPartial('_rates',array('model'=>$model,'not_activated'=>$not_activated,'rates'=>$rates))?>
    <?php $this->renderPartial('_files',array('model'=>$model->driversFiles))?>
</div>
<script type="text/javascript">
    function updatePage()
    {
        $("#rates").on("hidden.bs.modal", function () {
            location.reload()
        });

    }
    </script>