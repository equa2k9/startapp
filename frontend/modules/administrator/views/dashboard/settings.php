<?php
$this->widget(
    'booster.widgets.TbTabs',
    array(
        'type' => 'pills', // 'tabs' or 'pills'
        'tabs' => array(
            array(
                'label' => Yii::t('site','Delivery'),
                'content' => $this->renderPartial('_delivery',array('delivery'=>$delivery),true),
                'active' => true
            ),
            array('label' => 'Contacts', 'content' => $this->renderPartial('_contact',array('contact'=>$contact),true)),
            array('label' => 'Messages', 'content' => 'Messages Content'),
        ),
    )
);