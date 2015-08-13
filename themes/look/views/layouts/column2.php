<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!--CATALOG-->
<div class="catalog">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <?php
                $this->renderPartial('//site/_sidebarmenu');
                ?>
            </div>
            <div class="col-xs-9">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>