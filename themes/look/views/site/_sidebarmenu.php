
<div class="filters">
    <div class="side_box">
        <h3><?php echo Yii::t('site', 'Filtering') ?></h3>
    </div>
    <div class="side_box">
        <div class="filters_list">
            <p><?php echo Yii::t('site', 'Categories') ?></p>
            <?php
            $this->widget(
                    'frontend.components.ExtendedMenu', array(
                'type' => 'list',
                'activateParents' => true,
//                'htmlOptions' => array('class' => false),
                'items' => Categories::getCategoriesMenu(),
            ));
            ?>
        </div>
    </div>
</div>