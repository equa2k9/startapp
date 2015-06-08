<?php

class RoutesheetController extends DriverController
{

    public function actions()
    {
        return array(
            'index' => 'common.components.actions.RoutesheetAction',
            'view' => 'common.components.actions.RoutesheetActionView',
        );
    }

}
