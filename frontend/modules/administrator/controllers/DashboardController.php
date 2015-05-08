<?php

class DashboardController extends ModuleController
{

    public function actions()
    {
        return array(
            'routesheet' => 'common.components.actions.RoutesheetAction',
            'drivers' => 'common.components.actions.DriverAction',
            'driversForms' => 'common.components.actions.DriverAction',

            'updateClientsRate'=>array(
                'class'=>'common.components.actions.UpdateEditable',
                'model_name'=>'ClientsRate',
            ),
            'updateDriver'=>array(
                'class'=>'common.components.actions.UpdateEditable',
                'model_name'=>'DriversInfo',
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }


    /*
     * Driver actions
     */
    public function actionViewDriver($id = null)
    {
        $model = Users::model()->all_drivers()->with('driversInfo', 'driversFiles', 'driversRates')->findByPk($id);

        if (!$id || !$model) {
            Yii::app()->user->setFlash('danger', 'You request bad link.');
            $this->redirect(Yii::app()->createUrl('administrator/dashboard/drivers'));
        }

//        $rates = new CActiveDataProvider('DriversRate',array('criteria'=>array('condition'=>'users_id ='.$model->id)));
        $rates = DriversRate::model()->search($id);

        $this->render('/driver/viewDriver', array('model' => $model, 'rates' => $rates));
    }

    public function actionEnrollDriver()
    {
        if ((int)$id = Yii::app()->request->getParam('id')) {
            if ($model = Users::model()->not_activated()->findByPk($id)) {
                if ($model->activateDriver()) {
                    Yii::app()->user->setFlash(
                        'success',
                        'Driver successfuly enrolled.<br>Please, set rates to this driver!'
                    );
                    $this->redirect(Yii::app()->createUrl('administrator/dashboard/viewDriver/' . $model->id));
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already activated');
        $this->redirect(Yii::app()->createUrl('administrator/dashboard/driversForms'));
    }

    public function actionDeactivateDriver()
    {
        if ((int)$id = Yii::app()->request->getParam('id')) {
            if ($model = Users::model()->activated()->findByPk($id)) {
                if ($model->deactivateDriver()) {
                    Yii::app()->user->setFlash('success', 'Driver successfuly deactivated!');
                    $this->redirect(Yii::app()->createUrl('administrator/dashboard/viewDriver/' . $model->id));
                }
            }
        }
        Yii::app()->user->setFlash('danger', 'You request bad link. Or driver already deactivated');
        $this->redirect(Yii::app()->createUrl('administrator/dashboard/drivers'));
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

    public function actionDeleteRate($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {
                DriversRate::model()->deleteByPk($id);
            }
        }
    }

    /*
     * CLIENTS actions
     */
    public function actionClients()
    {
        $model = new Clients('search');

        $model->unsetAttributes();

        if (isset($_GET['Clients'])) {
            $model->attributes = $_GET['Clients'];
        }

        $this->render('/clients/index', array('model' => $model));
    }

    public function actionClientsRate()
    {
        $clientId = Yii::app()->request->getParam('id');
        $clientsRate = ClientsRate::model()->findByPk($clientId);

        $this->renderPartial(
            '/clients/_clientsRate',
            array(
                'id' => $clientId,
                'clientsRate' => $clientsRate,
            ), false, true);
    }

    public function actionCreateClient()
    {
        $model = new Clients();
        $model->with('clientsRate');

        $this->render('/clients/create',array('model'=>$model));
    }

    /**
     * overdrived function to set menu
     */
    public function getMenu()
    {
        return $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/administrator',
            ),
            array('label' => 'Route Sheets', 'url' => '/administrator/dashboard/routesheet'),
            array('label' => 'Waybills', 'url' => '/administrator/dashboard/waybill'),
            array('label' => 'Cashiering Receipts', 'url' => '/administrator/dashboard/cashreceipt'),
            array('label' => 'Drivers', 'url' => '/administrator/dashboard/drivers'),
            array('label' => 'Drivers Forms', 'url' => '/administrator/dashboard/driversForms'),
            array('label' => 'Clients', 'url' => '/administrator/dashboard/clients'),
        );
    }

}
