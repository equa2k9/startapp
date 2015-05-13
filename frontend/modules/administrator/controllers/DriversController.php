<?php
class DriversController extends AdministratorController
{
    public function actions()
    {
        return array(
            'index' => 'common.components.actions.DriverAction',
            'forms' => 'common.components.actions.DriverAction',

            'update'=>array(
                'class'=>'common.components.actions.UpdateEditable',
                'model_name'=>'DriversInfo',
            ),
            'deleteRate'=>array(
                'class'=>'common.components.actions.DeleteAjaxAction',
                'model_name'=>'DriversRate',
            ),
        );
    }

    /*
     * Driver actions
     */
    public function actionView($id = null)
    {
        $model = Users::model()->all_drivers()->with('driversInfo', 'driversFiles', 'driversRates')->findByPk($id);

        if (!$id || !$model) {
            Yii::app()->user->setFlash('danger', 'You request bad link.');
            $this->redirect(Yii::app()->createUrl('administrator/drivers'));
        }


        $rates = DriversRate::model()->search($id);

        $this->render('viewDriver', array('model' => $model, 'rates' => $rates));
    }

    public function actionEnroll()
    {
        if ((int)$id = Yii::app()->request->getParam('id')) {
            if ($model = Users::model()->not_activated()->findByPk($id)) {
                if ($model->activateDriver()) {
                    Yii::app()->user->setFlash(
                        'success',
                        'Driver successfuly enrolled.<br>Please, set rates to this driver!'
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
        if ((int)$id = Yii::app()->request->getParam('id')) {
            if ($model = Users::model()->activated()->findByPk($id)) {
                if ($model->deactivateDriver()) {
                    Yii::app()->user->setFlash('success', 'Driver successfuly deactivated!');
                    $this->redirect(Yii::app()->createUrl('administrator/drivers/view/' . $model->id));
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already deactivated');
        $this->redirect(Yii::app()->createUrl('administrator/drivers'));
    }

    /**
     * ajax action to set rate for driver
     */
    public function actionSetRate()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {
                $data = array();
                $model = new DriversRate();
                $model->attributes = Yii::app()->request->getPost('DriversRate');
                if ($model->save()) {
                    $data['status'] = 'success';
                } else {
                    $data = $model->errors;
                }
                echo CJSON::encode($data);
            }
            Yii::app()->end();
        } else {
            Yii::app()->user->setFlash('danger', 'You request bad link');
            $this->redirect(Yii::app()->createUrl('administrator'));
        }
    }

    public function actionAddComment()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {
                $data = array();
                $model = new DriversComments();
                $model->attributes = Yii::app()->request->getPost('DriversComments');
                if ($model->save()) {
                    $data['status'] = 'success';
                } else {
                    $data = $model->errors;
                }
                echo CJSON::encode($data);
            }
            Yii::app()->end();
        } else {
            Yii::app()->user->setFlash('danger', 'You request bad link');
            $this->redirect(Yii::app()->createUrl('administrator/drivers'));
        }
    }
}