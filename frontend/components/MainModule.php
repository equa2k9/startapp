<?php

class MainModule extends CWebModule
{

    public $defaultController = 'dashboard';
    public $moduleName = '';

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        Yii::app()->theme = 'bootstrap';
        // import the module-level models and components
        $this->setImport(array(
            $this->moduleName . '.models.*',
            $this->moduleName . '.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
