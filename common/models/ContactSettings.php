<?php

class ContactSettings extends CFormModel {

    public $email1;
    public $email2;
    public $phone1;
    public $phone2;
    public $adress_uk;
    public $adress_ru;
    public $adress_en;
    public $astore_en;
    public $astore_uk;
    public $astore_ru;
    public $about_en;
    public $about_uk;
    public $about_ru;

    public function init() {

        $this->phone1 = Yii::app()->settings->get('admin', 'phone1');
        $this->adress_uk = Yii::app()->settings->get('admin', 'adress_uk');
        $this->phone2 = Yii::app()->settings->get('admin', 'phone2');
        $this->adress_ru = Yii::app()->settings->get('admin', 'adress_ru');
        $this->email1 = Yii::app()->settings->get('admin', 'email1');
        $this->email2 = Yii::app()->settings->get('admin', 'email2');
        $this->adress_en = Yii::app()->settings->get('admin', 'adress_en');
        $this->astore_en = Yii::app()->settings->get('admin', 'astore_en');
        $this->astore_ru = Yii::app()->settings->get('admin', 'astore_ru');
        $this->astore_uk = Yii::app()->settings->get('admin', 'astore_uk');
         $this->about_uk = Yii::app()->settings->get('admin', 'about_uk');
         $this->about_en = Yii::app()->settings->get('admin', 'about_en');
         $this->about_ru = Yii::app()->settings->get('admin', 'about_ru');
    }
    
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('adress_uk,adress_ru,adress_en,email1,email2,phone1,phone2,astore_uk,astore_en,astore_ru', 'safe'),
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
    public function attributeLabels()
    {
        return array(
           'astore_uk'=>'About store uk',
             'astore_ru'=>'About store ru',
             'astore_en'=>'About store en',
            'about_uk'=>'About us uk',
            'about_ru'=>'About us ru',
            'about_en'=>'About us en'
        );
    }
    
    

}
