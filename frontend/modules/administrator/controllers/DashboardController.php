<?php

class DashboardController extends AdministratorController
{

//    public function actions()
//    {
//        return array(
//        );
//    }

    public function actionIndex()
    {
        $this->render('index');
    }

    /*     * *
     * action to view logging activity of users
     */

    public function actionActivity()
    {
        $model = new Activity('search');
        $model->with('users');
        $model->unsetAttributes();

        if (isset($_GET['Activity']))
        {
            $model->attributes = $_GET['Activity'];
        }

        $this->render('activity', array('model' => $model));
    }
    
    public function actionSettings()
    {
        $delivery = new Delivery();
        $contact = new ContactSettings();
        if(Yii::app()->request->isPostRequest)
        {
            if($delivery->attributes = Yii::app()->request->getPost('Delivery')) 
                $delivery->save();
            if($contact->attributes = Yii::app()->request->getPost('ContactSettings')) 
                $contact->save();
        }
        
        $this->render('settings',array('delivery'=>$delivery,'contact'=>$contact));
    }


}
