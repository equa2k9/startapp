<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModuleController extends FrontendSiteController
{

    public $layout = '//layouts/column1';
    public $menu = array();

    public function getMenu()   //getter to set menu items, in module controllers
    {
        return $this->menu;
    }

    public function init()
    {
        $this->getMenu(); //in init this sets menu list
        parent::init();
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {

        return array(
            array('allow', // allow all users to perform the 'login' action
                'actions' => array('error'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                'expression' => 'Yii::app()->user->role ==Yii::app()->controller->module->id',
            ),
            array('deny'),
        );
    }

}
