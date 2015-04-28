<?php

class DashboardController extends ModuleController
{

    public function actions()
    {
        return array(
            'routesheet' => 'common.components.actions.RoutesheetAction',
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function getMenu()
    {
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/driver',
            ),
            array('label' => 'Route Sheets', 'url' => '/driver/dashboard/routesheet'),
            array('label' => 'Waybills', 'url' => '/driver/dashboard/waybill'),
            array('label' => 'Cashiering Receipts', 'url' => '/driver/dashboard/cashreceipt'),
            array('label' => 'Driver form', 'url' => '/users/dashboard/driverForm'),
        );
    }

}
