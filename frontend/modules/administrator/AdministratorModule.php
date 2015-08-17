<?php

class AdministratorModule extends MainModule
{

    public $moduleName = 'administrator';
    
    public function init()
    {
        Yii::app()->theme = 'sb-admin';
        parent::init();
    }

}
