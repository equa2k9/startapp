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

    public function actionRate()
    {
        $clientId = Yii::app()->request->getParam('id');
        $clientsRate = ClientsRate::model()->findByPk($clientId);
        if(!$clientsRate)
        {
            $clientsRate = new ClientsRate();
            $clientsRate->id = $clientId;
        }
        $this->renderPartial('_clientsRate',array(
                'id' => $clientId,
                'clientsRate' => $clientsRate,
            ), false, true);
    }

    public function actionCreate()
    {
        $model = new Clients();
        $model->with('clientsRate');


        $this->render('create',array('model'=>$model));
    }

}