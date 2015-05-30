<?php

class RoutesheetActionView extends CommonAction
{

    public function run()
    {
        $id = Yii::app()->request->getParam('id');

        if (!$model = Routesheet::model()->driverOrAll()->findByPk($id))
        {
            Yii::app()->user->setFlash('danger', 'You requested bad link or Route Sheet is deleted.');
            Yii::app()->request->redirect('/'.Yii::app()->user->role.'/routesheet/');
        }

        $trips = new Trips('search');

        $trips->with(array('tripsInfo', 'tripsPassengers'=>array('with'=>array('tripsPays','passengers'=>array('with'=>'clients')))))->routesheet($id);

        $trips->unsetAttributes();
        if(isset($_GET['Trips']))
        {
            $trips->attributes = $_GET['Trips'];
        }

        $this->render('//routesheet/view', array('model' => $model, 'trips' => $trips));
    }

}
