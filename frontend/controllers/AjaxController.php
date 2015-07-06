<?php
class AjaxController extends CController
{
    public function actionChangeView()
    {
        if(Yii::app()->request->isAjaxRequest && Yii::app()->request->isPostRequest)
        {
            
            if(Yii::app()->request->getPost('type')=='list')
            {
                Yii::app()->session['view']='list';
            }
            if(Yii::app()->request->getPost('type')=='square')
            {
                Yii::app()->session['view']='square';
            }
        }
        Yii::app()->end();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

