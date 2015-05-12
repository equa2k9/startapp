<?php
class RoutesheetController extends AdministratorController
{
    public function actions()
    {
        return array(
            'index' => 'common.components.actions.RoutesheetAction',
        );
    }
}