<?php
class DriverController extends ModuleController
{
    public function getMenu()
    {
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/driver',
            ),
            array('label' => 'Route Sheets', 'url' => '/driver/routesheet'),
            array('label' => 'Waybills', 'url' => '/driver/waybills'),
            array('label' => 'Cashiering Receipts', 'url' => '/driver/receipts'),
            array('label' => 'Driver form', 'url' => '/users/dashboard/driverForm'),
        );
    }
}