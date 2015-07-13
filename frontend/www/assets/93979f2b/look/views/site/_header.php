 <!--HEADER-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 columns">
                    <div class="logo">
                        <img src="<?php echo Yii::app()->assetManager->publish(Yii::app()->theme->basePath.'/img/logo.png')?>" alt="">
                    </div>
                </div>
                <div class="col-xs-6 columns">
                    
                        
                        <?php
            $this->widget(
                    'frontend.components.ExtendedMenuMain', array(
                'type' => 'list',
                'activateParents' => true,
                'items' =>  array(array('label' => Yii::t('site', 'Home'), 'url' => array('/'), 'linkOptions' => array('class'=>(Yii::app()->controller->id == "site"&&Yii::app()->controller->action->id=="index")?'nav_btn active':'nav_btn'),),
                array('label' => Yii::t('site', 'Catalog'), 'url' => array('/catalog'), 'linkOptions' => array('class'=>(Yii::app()->controller->id == "catalog")?'nav_btn active':'nav_btn')),
                array('label' => Yii::t('site', 'News'), 'url' => Yii::app()->createUrl('/news'), 'linkOptions' => array('class'=>(Yii::app()->controller->id == "news")?'nav_btn active':'nav_btn')),
                array('label' => Yii::t('site', 'Forum'), 'url' => array('/forum'), 'linkOptions' => array('class'=>'nav_btn')),
                array('label' => Yii::t('site', 'About us'), 'url' => array('/about'), 'linkOptions' => array('class'=>(Yii::app()->controller->action->id == "about")?'nav_btn active':'nav_btn')),
                array('label' => Yii::t('site', 'Contact'), 'url' => array('/contact'), 'linkOptions' => array('class'=>(Yii::app()->controller->action->id == "contact")?'nav_btn active':'nav_btn')),
            )));
            ?>
                    
                </div>
            </div>
        </div>
    </header>
    <!--HEADER-->