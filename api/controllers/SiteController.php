<?php

class SiteController extends ApiSiteController
{

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('*'),
                'users' => array('*'),
            ),
        );
    }
   

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
       echo 'Api works fine';
    }

}
