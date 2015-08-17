<?php
$this->breadcrumbs = array(Yii::t('site', 'Catalog'), $model->category->name, $model->name);
$this->pageTitle = Yii::app()->name . " - " . $model->name;
?>
<div class="single_item shadow-z-3">
    <div>

        <?php
        foreach ($model->articlesPictures as $picture)
        {
            $pictureArray[] = array('image' => '/images/catalog/'.$picture->picture);
        }
        $this->widget(
                'booster.widgets.TbCarousel', array(
            'items' => $pictureArray,
                )
        );
        ?>

    </div>

    <div class="caption-full">
        <h4 class="pull-right"><?php // echo $model->price.' '.$model->getCurrency($model->currency);   ?></h4>
        <h4><?php echo $model->name; ?>
        </h4>
        <hr>
        <?php
        $this->widget(
                'booster.widgets.TbTabs', array(
            'type' => 'pills', // 'tabs' or 'pills'
            'justified' => true,
            'tabs' => array(
                array('label' => 'Детальний опис', 'content' => '<p>' . $model->description . '</p>', 'active' => true),
                array('label' => 'Специфікації', 'content' => '<p>' . '' . '</p>'),
            ),
                )
        );
        ?>
    </div>
    <div class="ratings">
        <p class="pull-right"><?php
            echo CHtml::ajaxLink("В корзину", CController::createUrl('cart/addToCart', array('id' => $model->id)), array('update' => '#data', 'success' => 'js: function(){$("#snack").snackbar();}'), array('class' => 'btn btn-success',
            ));
            ?></p>

        <div class="clearfix"></div>
    </div>

</div>

<div class="well" id="comments">


    <div class="row" id="addComment">
        <div class="col-md-12">
            <p class="pull-right"><?php // echo equaText::comment($count)   ?></p>
            <h4 class='text-info'>Залиште будь ласка коментар</h4>
            //<?php
//                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
//                        'id' => 'comment-form',
//                        'enableAjaxValidation' => true,
//                        'enableClientValidation' => true,
//                        'clientOptions' => array(
//                            'validateOnSubmit' => true,
//                        ),
//                        'action' => Yii::app()->createUrl('catalog/addComment'),
//                    ));
//                    
            ?>

            <?php // echo $form->textAreaGroup($comment, 'comment'); ?>
            <?php // echo $form->error($comment, 'comment'); ?>
            <?php // echo $form->hiddenField($model, 'id') ?>
            <?php
//                    $this->widget('bootstrap.widgets.TbButton', array(
//                        'buttonType' => 'submit',
////                                    'type' => 'primary',
//                        'label' => 'Добавити',
//                        'htmlOptions' => array('class' => 'btn btn-info pull-right'),
////                                    'class'=>'btn btn-action'
//                    ));
//                    
            ?>
            <?php // $this->endWidget();  ?>
        </div>
    </div>

    <hr>

    <?php
//            $this->widget('zii.widgets.CListView', array(
//                'dataProvider' => $commentProvider,
//                'itemView' => '_comments',
//                'enablePagination' => true,
//                'template' => "{sorter}\n{items}\n{pager}",
//                'emptyText' => 'На жаль, користувачі не залишили коментарів',
//                'pager' => array(
//                    'cssFile' => false,
//                    'htmlOptions' => array('class' => 'pagination'),
//                    'firstPageLabel' => 'Перша',
//                    'lastPageLabel' => 'Остання',
//                    'nextPageLabel' => 'Наступна',
//                    'prevPageLabel' => 'Попередня',
//                    'header' => '',
//                ),
//            ));
    ?>

</div>