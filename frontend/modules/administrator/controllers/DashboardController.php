<?php

class DashboardController extends AdministratorController
{

    public function actionIndex()
    {
        $this->render('index');
    }

    /***
     * action to view logging activity of users
     */
    public function actionActivity()
    {
        $model = new Activity('search');
        $model->with('users');
        $model->unsetAttributes();

        if(isset($_GET['Activity']))
        {
            $model->attributes = $_GET['Activity'];
        }

        $this->render('activity',array('model'=>$model));
    }

}
