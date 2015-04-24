<?php

class CommonController extends CController
{

    public function actionConfirm()
    {
        unset(Yii::app()->user->id);
        if (Yii::app()->request->getRequestType() === 'GET')
        {
            $link = Yii::app()->request->getParam('link');

            $model = Users::model()->findByAttributes(array('hash_link' => $link));

            if ($model)
            {
                $model->setScenario('confirm');
                $model->hash_link = NULL;
                $model->save(false);

                Yii::app()->user->setFlash('success', Yii::t('site', 'You successfuly confirm your e-mail. Please login'));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
            else
            {
                throw new CHttpException(404, 'Bad confirm link or you already confirm your e-mail');
            }
        }
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

