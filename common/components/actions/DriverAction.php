<?php

class DriverAction extends CommonAction
{

    public function run()
    {
        if ($this->getController()->getAction()->id == 'index')
        {
            $model = new Users('search');
        }
        if ($this->getController()->getAction()->id == 'forms')
        {
            $model = new Users('searchforms');
        }
        $model->unsetAttributes();

        if (isset($_GET['Users']))
        {
            $model->attributes = $_GET['Users'];
        }

        $this->render('allDrivers', array('model' => $model));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

