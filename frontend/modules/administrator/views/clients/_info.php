<div class="row">
    <div class="col-md-4">
        <h3>Main information:</h3>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbEditableDetailView', array(
            'data' => $model,
            'mode' => 'inline',
            'disabled' => false,
            'url' => $this->createUrl('update'), //common submit url for all fields
            'emptytext' => 'no value',
            'apply' => true, //you can turn off applying editable to all attributes
            'attributes' => array(
                'name',
                'phone',
                'email',
            ),
        ));
        ?>
    </div>