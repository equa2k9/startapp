<?php $this->renderPartial('_createPassenger', array('model' => new Passengers(), 'id' => $model->id), FALSE); ?>
<div class="page-header">
    <h2>
        View Client №<?php echo $model->id ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => 'Add new passenger',
            'context' => 'info',
            'htmlOptions' => array(
                'class' => 'pull-right',
                'data-toggle' => 'modal',
                'data-target' => '#create-passenger',
            ),
                )
        );
        ?>
    </h2>
</div>
<?php $this->renderPartial('_info', array('model' => $model), FALSE); ?>
<?php $this->renderPartial('_clientsRate', array('clientsRate' => $clientsRate), FALSE); ?>
<?php $this->renderPartial('_passengers', array('passengers' => $passengers), FALSE); ?>