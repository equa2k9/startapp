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
                    Yii::app()->user->setFlash('warning', 'Your driver profile is not activated. You will receive an e-mail notification');
                    $controller->redirect(Yii::app()->createUrl('users'));
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
