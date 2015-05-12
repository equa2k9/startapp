<?php
class ClientsController extends AdministratorController
{
    public function actions()
    {
        return array(
            'updateRate'=>array(
                'class'=>'common.components.actions.UpdateEditable',
                'model_name'=>'ClientsRate',
            ),
            'update'=>array(
                'class'=>'common.components.actions.UpdateEditable',
                'model_name'=>'Clients',
            ),
            'deletePassengers'=>array(
                'class'=>'common.components.actions.DeleteAjaxAction',
                'model_name'=>'Passengers',
            ),
            'delete'=>array(
                'class'=>'common.components.actions.DeleteAjaxAction',
                'model_name'=>'Clients',
            ),
        );
    }

    /*
     * CLIENTS actions
     */
    public function actionIndex()
    {
        $model = new Clients('search');

        $model->unsetAttributes();

        if (isset($_GET['Clients'])) {
            $model->attributes = $_GET['Clients'];
        }

        $this->render('index', array('model' => $model));
    }

    public function actionView($id = NULL)
    {
        $model = Clients::model()->findByPk($id);
        if (!$id || !$model) {
            Yii::app()->user->setFlash('danger', 'You request bad link.');
            $this->redirect(Yii::app()->createUrl('administrator/clients'));
        }
        $passengers = new Passengers('search');
        $passengers->clients_id = $id;

        $clientsRate = ClientsRate::model()->findByPk($id);

        $this->render('viewClients', array('model' => $model, 'passengers' => $passengers,'clientsRate'=>$clientsRate));
    }

    public function actionCreate()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {

                $data = array();
                $model = new Clients();
                $clientsRate = new ClientsRate();
                $model->attributes = Yii::app()->request->getPost('Clients');
                if ($model->save()) {
                    $clientsRate->id =$model->id;
                    $clientsRate->save(false);
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
    public function actionCreatePassenger()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->request->isPostRequest) {

                $data = array();
                $model = new Passengers();

                $model->attributes = Yii::app()->request->getPost('Passengers');

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

}