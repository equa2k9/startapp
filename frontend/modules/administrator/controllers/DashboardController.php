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
        $model = Users::model()->all_drivers()->with('driversInfo', 'driversFiles')->findByPk($id);

        if (!$id || !$model)
        {
            throw new CHttpException('Requested page is not exist', 404);
        }

        $this->render('viewDriver', array('model' => $model));
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
