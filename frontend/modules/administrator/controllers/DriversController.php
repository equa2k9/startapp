<?php

class DriversController extends AdministratorController
{

    public function actions()
    {
        return array(
            'index' => 'common.components.actions.DriverAction',
            'forms' => 'common.components.actions.DriverAction',
            'update' => array(
                'class' => 'common.components.actions.UpdateEditable',
                'model_name' => 'DriversInfo',
            ),
            'deleteRate' => array(
                'class' => 'common.components.actions.DeleteAjaxAction',
                'model_name' => 'DriversRate',
            ),
            'setRate' => array(
                'class' => 'common.components.actions.AjaxAdd',
                'model_name' => 'DriversRate',
            ),
            'addComment' => array(
                'class' => 'common.components.actions.AjaxAdd',
                'model_name' => 'DriversComments',
            ),
        );
    }

    /*
     * Driver actions
     */

    public function actionView($id = null)
    {
        $model = Users::model()->all_drivers()->with('driversInfo', 'driversFiles', 'driversRates')->findByPk($id);

        if (!$id || !$model)
        {
            Yii::app()->user->setFlash('danger', 'You request bad link.');
            $this->redirect(Yii::app()->createUrl('administrator/drivers'));
        }


        $rates = DriversRate::model()->search($id);

        $this->render('viewDriver', array('model' => $model, 'rates' => $rates));
    }

    public function actionEnroll()
    {
        if ((int) $id = Yii::app()->request->getParam('id'))
        {
            if ($model = Users::model()->not_activated()->findByPk($id))
            {
                if ($model->activateDriver())
                {
                    Yii::app()->user->setFlash(
                            'success', 'Driver successfuly enrolled.<br>Please, set rates to this driver!'
                    );
                    $this->redirect(Yii::app()->createUrl('administrator/drivers/view/' . $model->id));
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already activated');
        $this->redirect(Yii::app()->createUrl('administrator/drivers/forms'));
    }

    public function actionDeactivate()
    {
        if ((int) $id = Yii::app()->request->getParam('id'))
        {
            if ($model = Users::model()->activated()->findByPk($id))
            {
                if ($model->deactivateDriver())
                {
                    Yii::app()->user->setFlash('success', 'Driver successfuly deactivated!');
                    $this->redirect(Yii::app()->createUrl('administrator/drivers/view/' . $model->id));
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already deactivated');
        $this->redirect(Yii::app()->createUrl('administrator/drivers'));
    }

}
