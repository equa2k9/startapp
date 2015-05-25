<?php

class DashboardController extends AdministratorController
{
    public function actions()
    {
        return array(
            'updateTripsStatus' => array(
                'class' => 'common.components.actions.UpdateEditable',
                'model_name' => 'TripsStatus',
            ),
            'updateRouteStatus' => array(
                'class' => 'common.components.actions.UpdateEditable',
                'model_name' => 'RoutesheetStatus',
            ),
            'deleteTripsStatus' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'TripsStatus',
            ),
            'deleteRouteStatus' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'RoutesheetStatus',
            ),
            'createTripsStatus' => array(
                'class' => 'common.components.actions.AjaxAdd',
                'model_name' => 'TripsStatus',
            ),
            'createRouteStatus' => array(
                'class' => 'common.components.actions.AjaxAdd',
                'model_name' => 'RoutesheetStatus',
            ),
        );
    }
    public function actionIndex()
    {
        $this->render('index');
    }

    /***
     * action to view logging activity of users
     */
    public function actionActivity()
    {
        $model = new Activity('search');
        $model->with('users');
        $model->unsetAttributes();

        if(isset($_GET['Activity']))
        {
            $model->attributes = $_GET['Activity'];
        }

        $this->render('activity',array('model'=>$model));
    }

    /***
     * action to view/edit/create statuses of routesheets and trips
     */
    public function actionStatuses()
    {
        $routeStatus = new RoutesheetStatus('search');
        $tripsStatus = new TripsStatus('search');

        $routeStatus->unsetAttributes();
        $tripsStatus->unsetAttributes();

        if(isset($_GET['RoutesheetStatus']))
        {
            $routeStatus->attributes = $_GET['RoutesheetStatus'];
        }

        if(isset($_GET['TripsStatus']))
        {
            $tripsStatus->attributes = $_GET['TripsStatus'];
        }

        $this->render('statuses',array('tripsStatus'=>$tripsStatus,'routeStatus'=>$routeStatus));
    }

}
