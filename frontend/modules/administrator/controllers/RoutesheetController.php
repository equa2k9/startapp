<?php

class RoutesheetController extends AdministratorController
{

    public function actions()
    {
        return array(
            'index' => 'common.components.actions.RoutesheetAction',
            'view' => 'common.components.actions.RoutesheetActionView',
            'delete' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'Routesheet',
            ),
        );
    }

}
