<?php

class DashboardController extends ModuleController
{

    public function actions()
    {
        return array(
            'routesheet' => 'common.components.actions.RoutesheetAction',
            'drivers'=>'common.components.actions.DriverAction',
            'driversForms'=>'common.components.actions.DriverAction'
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionViewDriver($id = NULL)
    {
        $model = Users::model()->all_drivers()->with('driversInfo', 'driversFiles','driversRates')->findByPk($id);

        if (!$id || !$model)
        {
            Yii::app()->user->setFlash('danger', 'You request bad link.');
            $this->redirect(Yii::app()->createUrl('administrator/dashboard/drivers'));
        }

        $this->render('viewDriver', array('model' => $model));
    }
    
    public function actionEnrollDriver()
    {
        if((int)$id = Yii::app()->request->getParam('id'))
        {
            if($model = Users::model()->not_activated()->findByPk($id))
            {
                if($model->activateDriver())
                {
                    Yii::app()->user->setFlash('success', 'Driver successfuly enrolled.<br>Please, set rates to this driver!');
                    $this->redirect(Yii::app()->createUrl('administrator/dashboard/viewDriver/'.$model->id));
                    
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already activated');
        $this->redirect(Yii::app()->createUrl('administrator/dashboard/driversForms'));
    }
    
    public function actionDriverRates()
    {
        
    }

    public function getMenu()
    {
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/administrator',
            ),
            array('label' => 'Route Sheets', 'url' => '/administrator/dashboard/routesheet'),
            array('label' => 'Waybills', 'url' => '/administrator/dashboard/waybill'),
            array('label' => 'Cashiering Receipts', 'url' => '/administrator/dashboard/cashreceipt'),
            array('label' => 'Drivers', 'url' => '/administrator/dashboard/drivers'),
            array('label' => 'Drivers Forms', 'url' => '/administrator/dashboard/driversForms'),
            array('label' => 'Clients', 'url' => '/administrator/dashboard/clients'),
        );
    }

}
