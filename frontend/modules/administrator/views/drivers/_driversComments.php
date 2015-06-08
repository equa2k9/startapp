<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'drivers-comments')
);
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Comments</h4>
</div>

<div class="modal-body">
    <div id="comments-block" class="well" style="max-height: 400px; height: auto;
         overflow-y: scroll;">
        <hr>

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => new CActiveDataProvider('DriversComments', array('criteria' => array('condition' => 'users_id=' . $model->id, 'with' => 'leaveComment'), 'pagination' => false)),
            'itemView' => '_comment',
            'id' => 'commentViewList',
            'template' => '{items}',
            'enablePagination' => false,
            'enableSorting' => false
        ));
        ?>

    </div>

    <?php
    $comments = new DriversComments();

    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'comments-form',
        'action' => Yii::app()->createUrl('administrator/drivers/addComment'),
        'type' => 'vertical',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well', 'validateOnSubmit' => false), // for insert effect
            )
    );
    ?>
    <?php echo $form->textAreaGroup($comments, 'message', array('rows' => 3)); ?>
    <?php echo $form->hiddenField($comments, 'users_id', array('value' => $model->id)) ?>
    <?php echo $form->hiddenField($comments, 'leave_comment_id', array('value' => Yii::app()->user->id)) ?>
    <?php echo $form->hiddenField($comments, 'created_at', array('value' => time())) ?>


</div>

<div class="modal-footer">
    <?php
    echo CHtml::ajaxSubmitButton(
            'Add comment', Yii::app()->createUrl('administrator/drivers/addComment'), array(
        'type' => 'POST',
        'data' => 'js:$("#comments-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $.fn.yiiListView.update("commentViewList");
                    var area = document.getElementById("comments-block");
                    if (area.selectionStart == area.selectionEnd) {
                    area.scrollTop = area.scrollHeight;
                }
                }
            }'
            ), array('class' => 'btn btn-primary',)
    );
    ?>
    <?php
    $this->widget(
            'booster.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
            )
    );
    ?>
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>