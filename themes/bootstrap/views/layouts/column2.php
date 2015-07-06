<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div id="content">
    <div class="row">
        <div class="col-md-3">
            <?php
            $this->renderPartial('//site/_dashmenu');
            ?>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>