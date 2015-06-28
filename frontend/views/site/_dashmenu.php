<div class="list-group">
   <?php
$this->widget(
            'booster.widgets.TbMenu', array(
        'type' => 'list',
                'htmlOptions'=>array(
                    'encode'=>false,
                ),
        'activateParents' => true,
        'items' => $this->menu,
                'htmlOptions'=>array()
            ));?>
  
</div>
<?php 
//array(
//            'class' => 'bootstrap.widgets.TbMenu',
//            'type' => 'navbar',
//            'activateParents' => true,
//            'items' => array(
//                array('label' => 'Home', 'url' => array('/site/index')),
//                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
//                array('label' => 'Contact', 'url' => array('/site/contact')),
//            ), 'htmlOptions' => array(
//            ),
//        ),
