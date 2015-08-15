<?php

class Delivery extends CFormModel {

    public $delivery1_uk;
    public $delivery2_uk;
    public $delivery1_en;
    public $delivery2_en;
    public $delivery1_ru;
    public $delivery2_ru;

    public function init() {

        $this->delivery1_uk = Yii::app()->settings->get('admin', 'delivery1_uk');
        $this->delivery2_uk = Yii::app()->settings->get('admin', 'delivery2_uk');
        $this->delivery1_ru = Yii::app()->settings->get('admin', 'delivery1_ru');
        $this->delivery2_ru = Yii::app()->settings->get('admin', 'delivery2_ru');
        $this->delivery1_en = Yii::app()->settings->get('admin', 'delivery1_en');
        $this->delivery2_en = Yii::app()->settings->get('admin', 'delivery2_en');
    }
    
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('delivery1_uk,delivery1_ru,delivery1_en,delivery2_uk,delivery2_ru,delivery2_en', 'safe'),
        );
    }
    public function save()
    {
        foreach($this->attributes as $key=>$attribute)
        {
            Yii::app()->settings->set('admin',$key,$attribute);
        }
        return true;
    }
//    public function attributeLabels()
//    {
//        return array(
//           
//        );
//    }
    
    

}
