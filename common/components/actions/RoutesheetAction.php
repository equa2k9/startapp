<?php

class RoutesheetAction extends CommonAction
{

    public function run()
    {
        $model = new Routesheet('search');

        $model->with(array('status', 'users'))->driverOrAll();
        $model->unsetAttributes();
        if (isset($_GET['Routesheet']))
        {
            $model->attributes = $_GET['Routesheet'];
        }
        $this->render('//dashboard/routesheet', array('model' => $model));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

