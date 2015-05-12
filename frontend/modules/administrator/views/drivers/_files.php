<div class="col-md-3">
    <h3>Files:</h3>
    <hr>
    <?php foreach ($model as $file): ?>
        <?php echo CHtml::link($file->name, Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/drivers_files/' . $file->users_id . '/' . $file->file)) ?>
        <hr>
    <?php endforeach ?>
</div>