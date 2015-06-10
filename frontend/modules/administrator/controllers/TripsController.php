<?php

class TripsController extends AdministratorController
{

    public function actions()
    {
        return array(
            'view' => 'common.components.actions.TripsActionView',
//            'create'=>'common.components.actions.TripsActionCreate',
            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'Trips',
            ),
            'getRowForm' => array(
                'class' => 'common.extensions.dynamictabularform.actions.GetRowForm',
                'view' => '//trips/_tripsPassengers',
                'modelClass' => 'TripsPassengers'
            ),
        );
    }

//    public function actionCreate()
//    {
//        $model = new Trips();
////        $model->tripsPassengers = array(new TripsPassengers());
////        $model->tripsInfo = new TripsInfo();
////        $model->routesheet = new Routesheet();
////        $model->tripsPays = new TripsPay();
//////        $model->trips
////
////
////        if (Yii::app()->request->isPostRequest)
////        {
////            if(Yii::app()->request->getPost('TripsPassengers'))
////            {
////                foreach(Yii::app()->request->getPost('TripsPassengers') as $key=>$passengers)
////                {
////                    var_dump($key,$passengers);exit;
////                }
////            }
////
////            $model->attributes = Yii::app()->request->getPost('TripsPassengers');
////        }
//
//        $this->render('//trips/create',array('model'=>$model));
//    }

    public function actionCreate()
    {
        $trips = new Trips();
        $routesheet = new Routesheet();
        $tripsInfo = new TripsInfo();
        $tripsPassengers = array(new TripsPassengers());

        if (isset($_POST)) {
//            $trips->attributes = $_POST['Trips'];


            if (isset($_POST['TripsPassengers'])) {
                $tripsPassengers = array();

                foreach ($_POST['TripsPassengers'] as $key => $value) {
                    $tripsPassenger = new TripsPassengers();
                    $tripsPassenger->tripsPays = new TripsPay();
                    $tripsPassenger->attributes = $value;
                    if(isset($_POST['TripsPay']))
                    {
                            $tripsPassenger->tripsPays->attributes = $_POST['TripsPay'][$key];
                    }
                    if (CommonHelper::checkAllEmptyAttributes($tripsPassenger)) {
                        $tripsPassengers[] = $tripsPassenger;
                    }
                }

                $valid = $trips->validate();

                foreach ($tripsPassengers as $passengers) {

                    $valid = $passengers->validate() &
                        $passengers->tripsPays->validate() &
                        $valid;
                }

                if ($valid) {
                    $transaction = $trips->getDbConnection()->beginTransaction();
                    try {
                        $trips->save();
                        $trips->refresh();

                        foreach ($tripsPassengers as $passengers) {
                            $passengers->trips_id = $trips->id;
                            $passengers->save();
                        }
                        $transaction->commit();
                    } catch (Exception $e) {
                        $transaction->rollback();
                    }


                    $this->redirect('create');
                }
//                var_dump($tripsPassengers);exit;
            }

        }
        $this->render(
            '//trips/create',
            array(
                'trips' => $trips,
                'tripsPassengers' => $tripsPassengers,
            )
        );
    }

    public function actionGetPassengers()
    {
        if(Yii::app()->request->isAjaxRequest&&Yii::app()->request->isPostRequest)
        {
            $data = Passengers::getPassengersByClient(Yii::app()->request->getParam('clients_id'));
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                    array('value'=>$value),CHtml::encode($name),true);
            }

        }
    }

}
