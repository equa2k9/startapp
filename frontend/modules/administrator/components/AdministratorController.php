<?php

class AdministratorController extends ModuleController
{

    /**
     * overdrived function to set menu
     */
    public function getMenu()
    {
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/administrator',
            ),
            array('label' => 'Route Sheets', 'url' => '/administrator/routesheet'),
            array('label' => 'Waybills', 'url' => '/administrator/waybills'),
            array('label' => 'Cashiering Receipts', 'url' => '/administrator/receipts'),
            array('label' => 'Drivers', 'url' => '/administrator/drivers'),
            array('label' => 'Drivers Forms', 'url' => '/administrator/drivers/forms'),
            array('label' => 'Clients', 'url' => '/administrator/clients'),
            array('label' => 'Activity', 'url' => '/administrator/dashboard/activity'),
            array('label' => 'Statuses', 'url' => '/administrator/dashboard/statuses'),
        );
    }

}
