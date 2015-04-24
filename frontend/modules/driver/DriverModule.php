<?php

class DriverModule extends MainModule
{

    public $moduleName = 'driver';

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            if (!Yii::app()->user->isGuest)
            {
                if (Users::current()->is_activated == Users::IS_ACTIVATED)
                {
                    return true;
                }
                else
                {
                    throw new CHttpException("Your Driver profile is not activated.", '');
                }
            }
            Yii::app()->request->redirect('/site/login');
        }
        else
        {
            return false;
        }
    }

}
